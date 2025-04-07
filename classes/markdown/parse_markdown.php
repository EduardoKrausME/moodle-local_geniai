<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * parse markdown file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\markdown;

/**
 * Class parse_markdown
 */
class parse_markdown {
    /** @var string */
    private $breaksenabled;

    /** @var bool */
    protected $safemode;

    /** @var bool */
    protected $markupescaped;

    /** @var array */
    private static $instances = [];

    /** @var array */
    protected $definitiondata;

    /** @var array */
    protected $specialcharacters = ['\\', '`', '*', "_", '{', '}', '[', ']', '(', ')', '>', '#', '+', '-', '.', '!', '|'];

    /** @var array */
    protected $strongregex = [
        '*' => '/^[*]{2}((?:\\\\\*|[^*]|[*][^*]*[*])+?)[*]{2}(?![*])/s',
        "_" => '/^__((?:\\\\_|[^_]|_[^_]*_)+?)__(?!_)/us',
    ];

    /** @var array */
    protected $emregex = [
        '*' => '/^[*]((?:\\\\\*|[^*]|[*][*][^*]+?[*][*])+?)[*](?![*])/s',
        "_" => '/^_((?:\\\\_|[^_]|__[^_]*__)+?)_(?!_)\b/us',
    ];

    /** @var string */
    protected $regexhtmlattribute = '[a-zA-Z_:][\w:.-]*(?:\s*=\s*(?:[^"\'=<>`\s]+|"[^"]*"|\'[^\']*\'))?';

    /** @var array */
    protected $voidmarkdownelements = [
        "area",
        "base",
        "br",
        "col",
        "command",
        "embed",
        "hr",
        "img",
        "input",
        "link",
        "meta",
        "param",
        "source",
    ];

    /** @var array */
    protected $textlevelmarkdownelements = [
        "a",
        "br",
        "bdo",
        "abbr",
        "blink",
        "nextid",
        "acronym",
        "basefont",
        "b",
        "em",
        "big",
        "cite",
        "small",
        "spacer",
        "listing",
        "i",
        "rp",
        "del",
        "code",
        "strike",
        "marquee",
        "q",
        "rt",
        "ins",
        "font",
        "strong",
        "s",
        "tt",
        "kbd",
        "mark",
        "u",
        "xm",
        "sub",
        "nobr",
        "sup",
        "ruby",
        "var",
        "span",
        "wbr",
        "time",
    ];

    /** @var array */
    protected $safelinkswhitelist = [
        "http://",
        "https://",
        "ftp://",
        "ftps://",
        "mailto:",
        "data:image/png;base64,",
        "data:image/gif;base64,",
        "data:image/jpeg;base64,",
        "irc:",
        "ircs:",
        "git:",
        "ssh:",
        "news:",
        "steam:",
    ];

    /** @var array */
    protected $markdownblocktypes = [
        "#" => ["Header"],
        "*" => ["Rule", "List"],
        "+" => ["List"],
        "-" => ["SetextHeader", "Table", "Rule", "List"],
        "0" => ["List"],
        "1" => ["List"],
        "2" => ["List"],
        "3" => ["List"],
        "4" => ["List"],
        "5" => ["List"],
        "6" => ["List"],
        "7" => ["List"],
        "8" => ["List"],
        "9" => ["List"],
        ":" => ["Table"],
        "<" => ["Comment", "Markup"],
        "=" => ["SetextHeader"],
        ">" => ["Quote"],
        "[" => ["Reference"],
        "_" => ["Rule"],
        "`" => ["FencedCode"],
        "|" => ["Table"],
        "~" => ["FencedCode"],
    ];

    /** @var array */
    protected $unmarkedmarkdownblocktypes = [
        "Code",
    ];

    /** @var array */
    protected $inlinetypes = [
        '"' => ["SpecialCharacter"],
        "!" => ["Image"],
        "&" => ["SpecialCharacter"],
        "*" => ["Emphasis"],
        ":" => ["Url"],
        "<" => ["UrlTag", "EmailTag", "Markup", "SpecialCharacter"],
        ">" => ["SpecialCharacter"],
        "[" => ["Link"],
        "_" => ["Emphasis"],
        "`" => ["Code"],
        "~" => ["Strikethrough"],
        '\\' => ["EscapeSequence"],
    ];

    /** @var string */
    protected $inlinemarkerlist = '!"*_&[:<>`~\\';

    /** @var bool */
    protected $urlslinked = true;

    /**
     * parse markdown constructor.
     *
     * @param bool $sanitize
     */
    public function __construct($sanitize = true) {
        $this->safemode = $sanitize;
        $this->breaksenabled = true;

        if (true === $sanitize) {
            $this->urlslinked = true;
            $this->markupescaped = true;
        }
    }

    /**
     * Set Markup Contents
     *
     * @param string $text
     *
     * @return bool
     */
    public function markdown_text(string $text) {
        // Make sure no definitions are set.
        $this->definitiondata = [];

        // Standardize line breaks.
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        // Remove surrounding line breaks.
        $text = trim($text, "\n");

        // Split text into lines.
        $lines = explode("\n", $text);

        // Iterate through lines to identify blocks.
        $markup = $this->lines($lines);

        // Trim line breaks.
        $markup = trim($markup, "\n");

        return $markup;
    }

    /**
     * lines function
     *
     * @param array $lines
     *
     * @return string
     */
    protected function lines(array $lines) {
        $currentmarkdownblock = null;

        foreach ($lines as $line) {

            if (chop($line) === "") {

                if (isset($currentmarkdownblock)) {
                    $currentmarkdownblock["interrupted"] = true;
                }

                continue;
            }

            if (strpos($line, "\t") !== false) {

                $parts = explode("\t", $line);

                $line = $parts[0];

                unset($parts[0]);

                foreach ($parts as $part) {
                    $shortage = 4 - mb_strlen($line, "utf-8") % 4;

                    $line .= str_repeat(" ", $shortage);
                    $line .= $part;
                }
            }

            $indent = 0;

            while (isset($line[$indent]) && $line[$indent] === " ") {
                $indent++;
            }

            $text = $indent > 0 ? substr($line, $indent) : $line;

            $line = ["body" => $line, "indent" => $indent, "text" => $text];

            if (isset($currentmarkdownblock["continuable"])) {

                $type = strtolower($currentmarkdownblock["type"]);
                $markdownblock = $this->{"block_" . $type . "_continue"}($line, $currentmarkdownblock);

                if (isset($markdownblock)) {

                    $currentmarkdownblock = $markdownblock;

                    continue;

                } else {

                    if ($this->ismarkdown_block_completable($currentmarkdownblock["type"])) {
                        $type = strtolower($currentmarkdownblock["type"]);
                        $currentmarkdownblock = $this->{"block_" . $type . "_complete"}($currentmarkdownblock);
                    }
                }
            }

            $marker = $text[0];

            $blocktypes = $this->unmarkedmarkdownblocktypes;

            if (isset($this->markdownblocktypes[$marker])) {
                foreach ($this->markdownblocktypes[$marker] as $blocktype) {
                    $blocktypes[] = $blocktype;
                }
            }

            foreach ($blocktypes as $blocktype) {
                $markdownblock = $this->{"block_" . $blocktype}($line, $currentmarkdownblock);

                if (isset($markdownblock)) {
                    $markdownblock["type"] = $blocktype;

                    if (!isset($markdownblock["identified"])) {
                        $markdownblocks[] = $currentmarkdownblock;

                        $markdownblock["identified"] = true;
                    }

                    if ($this->is_markdown_block_continuable($blocktype)) {
                        $markdownblock["continuable"] = true;
                    }

                    $currentmarkdownblock = $markdownblock;

                    continue 2;
                }
            }

            if (isset($currentmarkdownblock) &&
                !isset($currentmarkdownblock["type"]) &&
                !isset($currentmarkdownblock["interrupted"])) {

                $currentmarkdownblock["element"]["text"] .= "\n" . $text;

            } else {
                $markdownblocks[] = $currentmarkdownblock;

                $currentmarkdownblock = $this->paragraph($line);

                $currentmarkdownblock["identified"] = true;
            }
        }

        if (isset($currentmarkdownblock["continuable"]) && $this->ismarkdown_block_completable($currentmarkdownblock["type"])) {
            $type = strtolower($currentmarkdownblock["type"]);
            $currentmarkdownblock = $this->{"block_" . $type . "_complete"}($currentmarkdownblock);
        }

        $markdownblocks[] = $currentmarkdownblock;

        unset($markdownblocks[0]);

        $markup = "";

        foreach ($markdownblocks as $markdownblock) {
            if (isset($markdownblock["hidden"])) {
                continue;
            }

            $markup .= "\n";
            $markup .= isset($markdownblock["markup"]) ? $markdownblock["markup"] : $this->element($markdownblock["element"]);
        }

        $markup .= "\n";

        return $markup;
    }

    /**
     * is markdown block continuable function
     *
     * @param string $type
     *
     * @return bool
     */
    protected function is_markdown_block_continuable(string $type) {
        return method_exists($this, "block_" . strtolower($type) . "_continue");
    }

    /**
     * ismarkdown block completable function
     *
     * @param string $type
     *
     * @return bool
     */
    protected function ismarkdown_block_completable(string $type) {
        return method_exists($this, "block_" . strtolower($type) . "_complete");
    }

    /**
     * block code function.
     *
     * @param array $line
     * @param array|null $markdownblock
     *
     * @return array|null
     */
    protected function block_code(array $line, ?array $markdownblock = null) {
        if (isset($markdownblock) && !isset($markdownblock["type"]) && !isset($markdownblock["interrupted"])) {
            return null;
        }

        if ($line["indent"] >= 4) {

            $text = substr($line["body"], 4);

            $markdownblock = [
                "element" => [
                    "name" => "pre",
                    "handler" => "element",
                    "text" => [
                        "name" => "code",
                        "text" => $text,
                    ],
                ],
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block code continue function.
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array
     */
    protected function block_code_continue(array $line, array $markdownblock) {
        if ($line["indent"] >= 4) {

            if (isset($markdownblock["interrupted"])) {
                $markdownblock["element"]["text"]["text"] .= "\n";

                unset($markdownblock["interrupted"]);
            }

            $markdownblock["element"]["text"]["text"] .= "\n";

            $text = substr($line["body"], 4);

            $markdownblock["element"]["text"]["text"] .= $text;

            return $markdownblock;
        }

        return null;
    }

    /**
     * block code complete function.
     *
     * @param array $markdownblock
     *
     * @return array
     */
    protected function block_code_complete(array $markdownblock) {
        $text = $markdownblock["element"]["text"]["text"];

        $markdownblock["element"]["text"]["text"] = $text;

        return $markdownblock;
    }

    /**
     * markdownBlock Comment
     *
     * @param array $line
     *
     * @return array
     */
    protected function block_comment(array $line) {
        if ($this->markupescaped || $this->safemode) {
            return null;
        }

        if (
            isset($line["text"][3]) &&
            $line["text"][3] === "-" &&
            $line["text"][2] === "-" &&
            $line["text"][1] === "!"
        ) {

            $markdownblock = [
                "markup" => $line["body"],
            ];

            if (preg_match('/-->$/', $line["text"])) {
                $markdownblock["closed"] = true;
            }

            return $markdownblock;
        }

        return null;
    }

    /**
     * block comment continue function.
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array|null
     */
    protected function block_comment_continue(array $line, array $markdownblock) {
        if (isset($markdownblock["closed"])) {
            return null;
        }

        $markdownblock["markup"] .= "\n" . $line["body"];

        if (preg_match('/-->$/', $line["text"])) {
            $markdownblock["closed"] = true;
        }

        return $markdownblock;
    }

    /**
     * Fenced Codes
     *
     * @param array $line
     *
     * @return mixed
     */
    protected function block_fencedcode(array $line) {
        if (preg_match('/^[' . $line["text"][0] . ']{3,}[ ]*([^`]+)?[ ]*$/', $line["text"], $matches)) {

            $markdownelement = [
                "name" => "code",
                "text" => "",
            ];

            if (isset($matches[1])) {
                /*
                 * https://www.w3.org/TR/2011/WD-html5-20110525/elements.html#classes
                 * Every HTML element may have a class attribute specified.
                 * The attribute, if specified, must have a value that is a set
                 * of space-separated tokens representing the various classes
                 * that the element belongs to.
                 * [...]
                 * The space characters, for the purposes of this specification,
                 * are U+0020 SPACE, U+0009 CHARACTER TABULATION (tab),
                 * U+000A LINE FEED (LF), U+000C FORM FEED (FF), and
                 * U+000D CARRIAGE RETURN (CR).
                 */
                $language = substr($matches[1], 0, strcspn($matches[1], " \t\n\f\r"));

                $class = 'language-' . $language;

                $markdownelement["attributes"] = [
                    "class" => $class,
                ];
            }

            $markdownblock = [
                "char" => $line["text"][0],
                "element" => [
                    "name" => "pre",
                    "handler" => "element",
                    "text" => $markdownelement,
                ],
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block fencedcode continue
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array|null
     */
    protected function block_fencedcode_continue(array $line, array $markdownblock) {
        if (isset($markdownblock["complete"])) {
            return null;
        }

        if (isset($markdownblock["interrupted"])) {
            $markdownblock["element"]["text"]["text"] .= "\n";

            unset($markdownblock["interrupted"]);
        }

        if (preg_match('/^' . $markdownblock["char"] . '{3,}[ ]*$/', $line["text"])) {
            $markdownblock["element"]["text"]["text"] = substr($markdownblock["element"]["text"]["text"], 1);

            $markdownblock["complete"] = true;

            return $markdownblock;
        }

        $markdownblock["element"]["text"]["text"] .= "\n" . $line["body"];

        return $markdownblock;
    }

    /**
     * block fencedcode complete function.
     *
     * @param array $markdownblock
     *
     * @return array
     */
    protected function block_fencedcode_complete(array $markdownblock) {
        $text = $markdownblock["element"]["text"]["text"];

        $markdownblock["element"]["text"]["text"] = $text;

        return $markdownblock;
    }

    /**
     * markdownBlock Header
     *
     * @param array $line
     *
     * @return array
     */
    protected function block_header($line) {
        if (isset($line["text"][1])) {
            $level = 1;

            while (isset($line["text"][$level]) && $line["text"][$level] === '#') {
                $level++;
            }

            if ($level > 6) {
                return null;
            }

            $text = trim($line["text"], '# ');

            $markdownblock = [
                "element" => [
                    "name" => "h" . min(6, $level),
                    "text" => $text,
                    "handler" => "line",
                ],
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block list function.
     *
     * @param array $line
     *
     * @return array
     */
    protected function block_list(array $line) {
        [$name, $pattern] = $line["text"][0] <= '-' ? ["ul", '[*+-]'] : ["ol", '[0-9]+[.]'];

        if (preg_match('/^(' . $pattern . '[ ]+)(.*)/', $line["text"], $matches)) {
            $markdownblock = [
                "indent" => $line["indent"],
                "pattern" => $pattern,
                "element" => [
                    "name" => $name,
                    "handler" => "elements",
                ],
            ];

            if ($name === "ol") {
                $liststart = stristr($matches[0], '.', true);

                if ($liststart !== "1") {
                    $markdownblock["element"]["attributes"] = ["start" => $liststart];
                }
            }

            $markdownblock["li"] = [
                "name" => "li",
                "handler" => "li",
                "text" => [
                    $matches[2],
                ],
            ];

            $markdownblock["element"]["text"][] = &$markdownblock["li"];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block list continue function.
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array|null
     */
    protected function block_list_continue(array $line, array $markdownblock) {
        $test = preg_match('/^' . $markdownblock["pattern"] . '(?:[ ]+(.*)|$)/', $line["text"], $matches);
        if ($markdownblock["indent"] === $line["indent"] && $test) {
            if (isset($markdownblock["interrupted"])) {
                $markdownblock["li"]["text"][] = "";

                $markdownblock["loose"] = true;

                unset($markdownblock["interrupted"]);
            }

            unset($markdownblock["li"]);

            $text = isset($matches[1]) ? $matches[1] : "";

            $markdownblock["li"] = [
                "name" => "li",
                "handler" => "li",
                "text" => [
                    $text,
                ],
            ];

            $markdownblock["element"]["text"][] = &$markdownblock["li"];

            return $markdownblock;
        }

        if ($line["text"][0] === '[' && $this->block_reference($line)) {
            return $markdownblock;
        }

        if (!isset($markdownblock["interrupted"])) {
            $text = preg_replace('/^[ ]{0,4}/', "", $line["body"]);

            $markdownblock["li"]["text"][] = $text;

            return $markdownblock;
        }

        if ($line["indent"] > 0) {
            $markdownblock["li"]["text"][] = "";

            $text = preg_replace('/^[ ]{0,4}/', "", $line["body"]);

            $markdownblock["li"]["text"][] = $text;

            unset($markdownblock["interrupted"]);

            return $markdownblock;
        }

        return null;
    }

    /**
     * block list complete function.
     *
     * @param array $markdownblock
     *
     * @return array
     */
    protected function block_list_complete(array $markdownblock) {
        if (isset($markdownblock["loose"])) {
            foreach ($markdownblock["element"]["text"] as &$li) {
                if (end($li["text"]) !== "") {
                    $li["text"][] = "";
                }
            }
        }

        return $markdownblock;
    }

    /**
     * block quote function.
     *
     * @param array $line
     *
     * @return array|null
     */
    protected function block_quote(array $line) {
        if (preg_match('/^>[ ]?(.*)/', $line["text"], $matches)) {

            $markdownblock = [
                "element" => [
                    "name" => "blockquote",
                    "handler" => "lines",
                    "text" => (array)$matches[1],
                ],
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block quote continue function.
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array|null
     */
    protected function block_quote_continue(array $line, array $markdownblock) {
        if ($line["text"][0] === '>' && preg_match('/^>[ ]?(.*)/', $line["text"], $matches)) {

            if (isset($markdownblock["interrupted"])) {

                $markdownblock["element"]["text"][] = "";

                unset($markdownblock["interrupted"]);
            }

            $markdownblock["element"]["text"][] = $matches[1];

            return $markdownblock;
        }

        if (!isset($markdownblock["interrupted"])) {

            $markdownblock["element"]["text"][] = $line["text"];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block rule function.
     *
     * @param array $line
     *
     * @return array|null
     */
    protected function block_rule(array $line) {
        if (preg_match('/^([' . $line["text"][0] . '])([ ]*\1){2,}[ ]*$/', $line["text"])) {

            $markdownblock = [
                "element" => [
                    "name" => "hr",
                ],
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block setextheader function.
     *
     * @param array $line
     * @param array|null $markdownblock
     *
     * @return array|null
     */
    protected function block_setextheader(array $line, array $markdownblock = null) {
        if (!isset($markdownblock) || isset($markdownblock["type"]) || isset($markdownblock["interrupted"])) {
            return null;
        }

        if (chop($line["text"], $line["text"][0]) === "") {

            $markdownblock["element"]["name"] = $line["text"][0] === '=' ? "h1" : "h2";

            return $markdownblock;
        }

        return null;
    }

    /**
     * block markup function.
     *
     * @param array $line
     *
     * @return array|null
     */
    protected function block_markup(array $line) {
        if ($this->markupescaped || $this->safemode) {
            return null;
        }

        if (preg_match('/^<(\w[\w-]*)(?:[ ]*' . $this->regexhtmlattribute . ')*[ ]*(\/)?>/', $line["text"], $matches)) {

            $element = strtolower($matches[1]);

            if (in_array($element, $this->textlevelmarkdownelements)) {
                return null;
            }

            $markdownblock = [
                "name" => $matches[1],
                "depth" => 0,
                "markup" => $line["text"],
            ];

            $length = strlen($matches[0]);

            $remainder = substr($line["text"], $length);

            if (trim($remainder) === "") {

                if (isset($matches[2]) || in_array($matches[1], $this->voidmarkdownelements)) {
                    $markdownblock["closed"] = true;

                    $markdownblock["void"] = true;
                }

            } else {
                if (isset($matches[2]) || in_array($matches[1], $this->voidmarkdownelements)) {
                    return null;
                }

                if (preg_match('/<\/' . $matches[1] . '>[ ]*$/i', $remainder)) {
                    $markdownblock["closed"] = true;
                }
            }

            return $markdownblock;
        }

        return null;
    }

    /**
     * block markup continue function.
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array|null
     */
    protected function block_markup_continue(array $line, array $markdownblock) {
        if (isset($markdownblock["closed"])) {
            return null;
        }

        // Open.
        if (preg_match('/^<' . $markdownblock["name"] . '(?:[ ]*' . $this->regexhtmlattribute . ')*[ ]*>/i', $line["text"])) {
            $markdownblock["depth"]++;
        }

        // Close.
        if (preg_match('/(.*?)<\/' . $markdownblock["name"] . '>[ ]*$/i', $line["text"], $matches)) {
            if ($markdownblock["depth"] > 0) {
                $markdownblock["depth"]--;
            } else {
                $markdownblock["closed"] = true;
            }
        }

        if (isset($markdownblock["interrupted"])) {
            $markdownblock["markup"] .= "\n";

            unset($markdownblock["interrupted"]);
        }

        $markdownblock["markup"] .= "\n" . $line["body"];

        return $markdownblock;
    }

    /**
     * block reference function.
     *
     * @param array $line
     *
     * @return array|null
     */
    protected function block_reference(array $line) {
        if (preg_match('/^\[(.+?)\]:[ ]*<?(\S+?)>?(?:[ ]+["\'(](.+)["\')])?[ ]*$/', $line["text"], $matches)) {

            $id = strtolower($matches[1]);

            $data = [
                "url" => $matches[2],
                "title" => null,
            ];

            if (isset($matches[3])) {
                $data["title"] = $matches[3];
            }

            $this->definitiondata["Reference"][$id] = $data;

            $markdownblock = [
                "hidden" => true,
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block table function.
     *
     * @param array $line
     * @param array|null $markdownblock
     *
     * @return array|null
     */
    protected function block_table($line, array $markdownblock = null) {
        if (!isset($markdownblock) || isset($markdownblock["type"]) || isset($markdownblock["interrupted"])) {
            return null;
        }

        if (strpos($markdownblock["element"]["text"], '|') !== false && chop($line["text"], ' -:|') === "") {
            $alignments = [];

            $divider = $line["text"];

            $divider = trim($divider);
            $divider = trim($divider, '|');

            $dividercells = explode('|', $divider);

            foreach ($dividercells as $dividercell) {
                $dividercell = trim($dividercell);

                if ($dividercell === "") {
                    continue;
                }

                $alignment = null;

                if ($dividercell[0] === ':') {
                    $alignment = "left";
                }

                if (substr($dividercell, -1) === ':') {
                    $alignment = $alignment === "left" ? "center" : "right";
                }

                $alignments[] = $alignment;
            }

            $headermarkdownelements = [];

            $header = $markdownblock["element"]["text"];

            $header = trim($header);
            $header = trim($header, '|');

            $headercells = explode('|', $header);

            foreach ($headercells as $index => $headercell) {
                $headercell = trim($headercell);

                $headermarkdownelement = [
                    "name" => "th",
                    "text" => $headercell,
                    "handler" => "line",
                ];

                if (isset($alignments[$index])) {
                    $alignment = $alignments[$index];

                    $headermarkdownelement["attributes"] = [
                        "style" => 'text-align: ' . $alignment . ';',
                    ];
                }

                $headermarkdownelements[] = $headermarkdownelement;
            }

            $markdownblock = [
                "alignments" => $alignments,
                "identified" => true,
                "element" => [
                    "name" => "table",
                    "handler" => "elements",
                ],
            ];

            $markdownblock["element"]["text"][] = [
                "name" => "thead",
                "handler" => "elements",
            ];

            $markdownblock["element"]["text"][] = [
                "name" => "tbody",
                "handler" => "elements",
                "text" => [],
            ];

            $markdownblock["element"]["text"][0]["text"][] = [
                "name" => "tr",
                "handler" => "elements",
                "text" => $headermarkdownelements,
            ];

            return $markdownblock;
        }

        return null;
    }

    /**
     * block table continue function.
     *
     * @param array $line
     * @param array $markdownblock
     *
     * @return array|null
     */
    protected function block_table_continue($line, array $markdownblock) {
        if (isset($markdownblock["interrupted"])) {
            return null;
        }

        if ($line["text"][0] === '|' || strpos($line["text"], '|')) {
            $markdownelements = [];

            $row = $line["text"];

            $row = trim($row);
            $row = trim($row, '|');

            preg_match_all('/(?:(\\\\[|])|[^|`]|`[^`]+`|`)+/', $row, $matches);

            foreach ($matches[0] as $index => $cell) {
                $cell = trim($cell);

                $markdownelement = [
                    "name" => "td",
                    "handler" => "line",
                    "text" => $cell,
                ];

                if (isset($markdownblock["alignments"][$index])) {
                    $markdownelement["attributes"] = [
                        "style" => 'text-align: ' . $markdownblock["alignments"][$index] . ';',
                    ];
                }

                $markdownelements[] = $markdownelement;
            }

            $markdownelement = [
                "name" => "tr",
                "handler" => "elements",
                "text" => $markdownelements,
            ];

            $markdownblock["element"]["text"][1]["text"][] = $markdownelement;

            return $markdownblock;
        }

        return null;
    }

    /**
     * paragraph function.
     *
     * @param array $line
     *
     * @return array
     */
    protected function paragraph($line) {
        $markdownblock = [
            "element" => [
                "name" => "p",
                "text" => $line["text"],
                "handler" => "line",
            ],
        ];

        return $markdownblock;
    }

    /**
     * Inline markdownElement
     *
     * @param string $text
     * @param array $nonnestables
     *
     * @return string
     */
    public function line(string $text, array $nonnestables = []) {
        $markup = "";

        // Excerpt is based on the first occurrence of a marker.

        while ($excerpt = strpbrk($text, $this->inlinemarkerlist)) {

            $marker = $excerpt[0];

            $markerposition = strpos($text, $marker);

            $excerpt = ["text" => $excerpt, "context" => $text];

            foreach ($this->inlinetypes[$marker] as $inlinetype) {
                // Check to see if the current inline type is nestable in the current context.

                if (!empty($nonnestables) && in_array($inlinetype, $nonnestables)) {
                    continue;
                }

                $inline = $this->{"inline_" . strtolower($inlinetype)}($excerpt);

                if (!isset($inline)) {
                    continue;
                }

                // Makes sure that the inline belongs to "our" marker.

                if (isset($inline["position"]) && $inline["position"] > $markerposition) {
                    continue;
                }

                // Sets a default inline position.

                if (!isset($inline["position"])) {
                    $inline["position"] = $markerposition;
                }

                // Cause the new element to "inherit" our non nestables.
                foreach ($nonnestables as $nonnestable) {
                    $inline["element"]["nonNestables"][] = $nonnestable;
                }

                // The text that comes before the inline.
                $unmarkedtext = substr($text, 0, $inline["position"]);

                // Compile the unmarked text.
                $markup .= $this->unmarked_text($unmarkedtext);

                // Compile the inline.
                $markup .= isset($inline["markup"]) ? $inline["markup"] : $this->element($inline["element"]);

                // Remove the examined text.
                $text = substr($text, $inline["position"] + $inline["extent"]);

                continue 2;
            }

            // The marker does not belong to an inline.

            $unmarkedtext = substr($text, 0, $markerposition + 1);

            $markup .= $this->unmarked_text($unmarkedtext);

            $text = substr($text, $markerposition + 1);
        }

        $markup .= $this->unmarked_text($text);

        return $markup;
    }

    /**
     * inline code function.
     *
     * @param array $excerpt
     *
     * @return array
     */
    protected function inline_code($excerpt) {
        $marker = $excerpt["text"][0];

        $regex = '/^(' . $marker . '+)[ ]*(.+?)[ ]*(?<!' . $marker . ')\1(?!' . $marker . ')/s';
        if (preg_match($regex, $excerpt["text"], $matches)) {
            $text = $matches[2];
            $text = preg_replace("/[ ]*\n/", ' ', $text);

            return [
                "extent" => strlen($matches[0]),
                "element" => [
                    "name" => "code",
                    "text" => $text,
                ],
            ];
        }

        return null;
    }

    /**
     * inline emailtag function.
     *
     * @param array $excerpt
     *
     * @return array
     */
    protected function inline_emailtag($excerpt) {
        if (strpos($excerpt["text"], '>') !== false && preg_match('/^<((mailto:)?\S+?@\S+?)>/i', $excerpt["text"], $matches)) {
            $url = $matches[1];

            if (!isset($matches[2])) {
                $url = 'mailto:' . $url;
            }

            return [
                "extent" => strlen($matches[0]),
                "element" => [
                    "name" => "a",
                    "text" => $matches[1],
                    "attributes" => [
                        "href" => $url,
                        "target" => "_blank",
                    ],
                ],
            ];
        }

        return null;
    }

    /**
     * inline emphasis function.
     *
     * @param array $excerpt
     *
     * @return array|null
     */
    protected function inline_emphasis(array $excerpt) {
        if (!isset($excerpt["text"][1])) {
            return null;
        }

        $marker = $excerpt["text"][0];

        if ($excerpt["text"][1] === $marker && preg_match($this->strongregex[$marker], $excerpt["text"], $matches)) {
            $emphasis = "strong";
        } else if (preg_match($this->emregex[$marker], $excerpt["text"], $matches)) {
            $emphasis = "i";
        } else {
            return null;
        }

        return [
            "extent" => strlen($matches[0]),
            "element" => [
                "name" => $emphasis,
                "handler" => "line",
                "text" => $matches[1],
            ],
        ];
    }

    /**
     * inline escapesequence function.
     *
     * @param array $excerpt
     *
     * @return array
     */
    protected function inline_escapesequence(array $excerpt) {
        if (isset($excerpt["text"][1]) && in_array($excerpt["text"][1], $this->specialcharacters)) {
            return [
                "markup" => $excerpt["text"][1],
                "extent" => 2,
            ];
        }

        return null;
    }

    /**
     * inline image function.
     *
     * @param array $excerpt
     *
     * @return array|null
     */
    protected function inline_image(array $excerpt) {
        if (!isset($excerpt["text"][1]) || $excerpt["text"][1] !== '[') {
            return null;
        }

        $excerpt["text"] = substr($excerpt["text"], 1);

        $link = $this->inline_link($excerpt);

        if ($link === null) {
            return null;
        }

        $inline = [
            "extent" => $link["extent"] + 1,
            "element" => [
                "name" => "img",
                "attributes" => [
                    "src" => $link["element"]["attributes"]["href"],
                    "alt" => $link["element"]["text"],
                ],
            ],
        ];

        $inline["element"]["attributes"] += $link["element"]["attributes"];

        unset($inline["element"]["attributes"]["href"]);

        return $inline;
    }

    /**
     * inline link function.
     *
     * @param array $excerpt
     *
     * @return array|null
     */
    protected function inline_link(array $excerpt) {
        $markdownelement = [
            "name" => "a",
            "handler" => "line",
            "nonNestables" => ["Url", "Link"],
            "text" => null,
            "attributes" => [
                "href" => null,
                "title" => null,
                "target" => "_blank",
            ],
        ];

        $extent = 0;

        $remainder = $excerpt["text"];

        if (preg_match('/\[((?:[^][]++|(?R))*+)\]/', $remainder, $matches)) {
            $markdownelement["text"] = $matches[1];

            $extent += strlen($matches[0]);

            $remainder = substr($remainder, $extent);
        } else {
            return null;
        }

        if (preg_match('/^[(]\s*+((?:[^ ()]++|[(][^ )]+[)])++)(?:[ ]+("[^"]*"|\'[^\']*\'))?\s*[)]/', $remainder, $matches)) {
            $markdownelement["attributes"]["href"] = $matches[1];

            if (isset($matches[2])) {
                $markdownelement["attributes"]["title"] = substr($matches[2], 1, -1);
            }

            $extent += strlen($matches[0]);
        } else {
            if (preg_match('/^\s*\[(.*?)\]/', $remainder, $matches)) {
                $definition = strlen($matches[1]) ? $matches[1] : $markdownelement["text"];
                $definition = strtolower($definition);

                $extent += strlen($matches[0]);
            } else {
                $definition = strtolower($markdownelement["text"]);
            }

            if (!isset($this->definitiondata["Reference"][$definition])) {
                return null;
            }

            $definition = $this->definitiondata["Reference"][$definition];

            $markdownelement["attributes"]["href"] = $definition["url"];
            $markdownelement["attributes"]["title"] = $definition["title"];
        }

        return [
            "extent" => $extent,
            "element" => $markdownelement,
        ];
    }

    /**
     * inline markup function.
     *
     * @param array $excerpt
     *
     * @return array|null
     */
    protected function inline_markup($excerpt) {
        if ($this->markupescaped || $this->safemode || strpos($excerpt["text"], '>') === false) {
            return null;
        }

        if ($excerpt["text"][1] === '/' && preg_match('/^<\/\w[\w-]*[ ]*>/s', $excerpt["text"], $matches)) {
            return [
                "markup" => $matches[0],
                "extent" => strlen($matches[0]),
            ];
        }

        if ($excerpt["text"][1] === '!' && preg_match('/^<!---?[^>-](?:-?[^-])*-->/s', $excerpt["text"], $matches)) {
            return [
                "markup" => $matches[0],
                "extent" => strlen($matches[0]),
            ];
        }

        $test = preg_match('/^<\w[\w-]*(?:[ ]*' . $this->regexhtmlattribute . ')*[ ]*\/?>/s', $excerpt["text"], $matches);
        if ($excerpt["text"][1] !== ' ' && $test) {
            return [
                "markup" => $matches[0],
                "extent" => strlen($matches[0]),
            ];
        }

        return null;
    }

    /**
     * inline specialcharacter function.
     *
     * @param array $excerpt
     *
     * @return array
     */
    protected function inline_specialcharacter($excerpt) {
        if ($excerpt["text"][0] === '&' && !preg_match('/^&#?\w+;/', $excerpt["text"])) {
            return [
                "markup" => '&amp;',
                "extent" => 1,
            ];
        }

        $specialcharacter = ['>' => "gt", '<' => "lt", '"' => "quot"];

        if (isset($specialcharacter[$excerpt["text"][0]])) {
            return [
                "markup" => '&' . $specialcharacter[$excerpt["text"][0]] . ';',
                "extent" => 1,
            ];
        }

        return null;
    }

    /**
     * inline strikethrough function.
     *
     * @param array $excerpt
     *
     * @return array|null
     */
    protected function inline_strikethrough($excerpt) {
        if (!isset($excerpt["text"][1])) {
            return null;
        }

        if ($excerpt["text"][1] === '~' && preg_match('/^~~(?=\S)(.+?)(?<=\S)~~/', $excerpt["text"], $matches)) {
            return [
                "extent" => strlen($matches[0]),
                "element" => [
                    "name" => "del",
                    "text" => $matches[1],
                    "handler" => "line",
                ],
            ];
        }

        return null;
    }

    /**
     * inline url function.
     *
     * @param array $excerpt
     *
     * @return array|null
     */
    protected function inline_url($excerpt) {
        if ($this->urlslinked !== true || !isset($excerpt["text"][2]) || $excerpt["text"][2] !== '/') {
            return null;
        }

        if (preg_match('/\bhttps?:[\/]{2}[^\s<]+\b\/*/ui', $excerpt["context"], $matches, PREG_OFFSET_CAPTURE)) {
            $url = $matches[0][0];

            $inline = [
                "extent" => strlen($matches[0][0]),
                "position" => $matches[0][1],
                "element" => [
                    "name" => "a",
                    "text" => $url,
                    "attributes" => [
                        "href" => $url,
                        "target" => "_blank",
                    ],
                ],
            ];

            return $inline;
        }

        return null;
    }

    /**
     * inline urltag function.
     *
     * @param array $excerpt
     *
     * @return array
     */
    protected function inline_urltag($excerpt) {
        if (strpos($excerpt["text"], '>') !== false && preg_match('/^<(\w+:\/{2}[^ >]+)>/i', $excerpt["text"], $matches)) {
            $url = $matches[1];

            return [
                "extent" => strlen($matches[0]),
                "element" => [
                    "name" => "a",
                    "text" => $url,
                    "attributes" => [
                        "href" => $url,
                        "target" => "_blank",
                    ],
                ],
            ];
        }

        return null;
    }

    /**
     * unmarked text function.
     *
     * @param string $text
     *
     * @return mixed|null|string|string[]
     */
    protected function unmarked_text($text) {
        if ($this->breaksenabled) {

            $text = preg_replace('/[ ]*\n/', "<br />\n", $text);

        } else {
            $text = preg_replace('/(?:[ ][ ]+|[ ]*\\\\)\n/', "<br />\n", $text);
            $text = str_replace(" \n", "\n", $text);
        }

        return $text;
    }

    /**
     * element function.
     *
     * @param array $markdownelement
     *
     * @return string
     */
    protected function element(array $markdownelement) {
        if ($this->safemode) {
            $markdownelement = $this->sanitise_markdown_element($markdownelement);
        }

        $markup = '<' . $markdownelement["name"];

        if (isset($markdownelement["attributes"])) {
            foreach ($markdownelement["attributes"] as $name => $value) {
                if ($value === null) {
                    continue;
                }

                $markup .= ' ' . $name . '="' . self::escape($value) . '"';
            }
        }

        $permitrawhtml = false;

        if (isset($markdownelement["text"])) {
            $text = $markdownelement["text"];
        } else if (isset($markdownelement["rawHtml"])) {
            // Very strongly consider an alternative if you're writing an extension.
            $text = $markdownelement["rawHtml"];
            $allowrawhtmlinsafemode =
                isset($markdownelement["allowRawHtmlInSafeMode"]) && $markdownelement["allowRawHtmlInSafeMode"];
            $permitrawhtml = !$this->safemode || $allowrawhtmlinsafemode;
        }

        if (isset($text)) {
            $markup .= '>';

            if (!isset($markdownelement["nonNestables"])) {
                $markdownelement["nonNestables"] = [];
            }

            if (isset($markdownelement["handler"])) {
                $markup .= $this->{$markdownelement["handler"]}($text, $markdownelement["nonNestables"]);
            } else if (!$permitrawhtml) {
                $markup .= self::escape($text, true);
            } else {
                $markup .= $text;
            }

            $markup .= '</' . $markdownelement["name"] . '>';
        } else {
            $markup .= ' />';
        }

        return $markup;
    }

    /**
     * elements function.
     *
     * @param array $markdownelements
     *
     * @return string
     */
    protected function elements(array $markdownelements) {
        $markup = "";

        foreach ($markdownelements as $markdownelement) {
            $markup .= "\n" . $this->element($markdownelement);
        }

        $markup .= "\n";

        return $markup;
    }

    /**
     * li function.
     *
     * @param array $lines
     *
     * @return bool|mixed|string
     */
    protected function li($lines) {
        $markup = $this->lines($lines);

        $trimmedmarkup = trim($markup);

        if (!in_array("", $lines) && substr($trimmedmarkup, 0, 3) === '<p>') {
            $markup = $trimmedmarkup;
            $markup = substr($markup, 3);

            $position = strpos($markup, "</p>");

            $markup = substr_replace($markup, "", $position, 4);
        }

        return $markup;
    }

    /**
     * parse function.
     *
     * @param string $text
     *
     * @return bool
     */
    public function parse($text) {
        $markup = $this->markdown_text($text);

        return $markup;
    }

    /**
     * sanitise markdown element function.
     *
     * @param array $markdownelement
     *
     * @return array
     */
    protected function sanitise_markdown_element(array $markdownelement) {
        static $goodattribute = '/^[a-zA-Z0-9][a-zA-Z0-9-_]*+$/';
        static $safeurlnametoatt = [
            "a" => "href",
            "img" => "src",
        ];

        if (isset($safeurlnametoatt[$markdownelement["name"]])) {
            $markdownelement = $this->filter_unsafe_url_in_attribute($markdownelement, $safeurlnametoatt[$markdownelement["name"]]);
        }

        if (!empty($markdownelement["attributes"])) {

            foreach ($markdownelement["attributes"] as $att => $val) {

                if (!preg_match($goodattribute, $att)) {
                    // Filter out badly parsed attribute.
                    unset($markdownelement["attributes"][$att]);
                } else if (self::stri_at_start($att, "on")) {
                    // Dump onevent attribute.
                    unset($markdownelement["attributes"][$att]);
                }
            }
        }

        return $markdownelement;
    }

    /**
     * filter unsafe url in attribute function.
     *
     * @param array $markdownelement
     * @param string $attribute
     *
     * @return array
     */
    protected function filter_unsafe_url_in_attribute(array $markdownelement, $attribute) {
        foreach ($this->safelinkswhitelist as $scheme) {

            if (self::stri_at_start($markdownelement["attributes"][$attribute], $scheme)) {
                return $markdownelement;
            }
        }

        $markdownelement["attributes"][$attribute] = str_replace(':', '%3A', $markdownelement["attributes"][$attribute]);

        return $markdownelement;
    }

    /**
     * Static Methods
     *
     * @param string $text
     * @param bool $allowquotes
     *
     * @return string
     */
    protected static function escape($text, $allowquotes = false) {
        return htmlspecialchars($text, $allowquotes ? ENT_NOQUOTES : ENT_QUOTES, 'UTF-8');
    }

    /**
     * Static Methods
     *
     * @param string $string
     * @param string $needle
     *
     * @return bool
     */
    protected static function stri_at_start($string, $needle) {
        $len = strlen($needle);

        if ($len > strlen($string)) {
            return false;
        } else {
            return strtolower(substr($string, 0, $len)) === strtolower($needle);
        }
    }

    /**
     * Static Methods
     *
     * @param string $name
     *
     * @return parse_markdown|mixed
     */
    protected static function instance($name = "default") {
        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }

        $instance = new static();

        self::$instances[$name] = $instance;

        return $instance;
    }
}

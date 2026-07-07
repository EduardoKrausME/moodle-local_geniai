# GeniAI (`local_geniai`)

`local_geniai` turns Moodle into a smarter and more interactive environment by adding a contextual virtual assistant, H5P content generation, pedagogical activity analysis, and AI usage reports.

It is a solution designed for institutions that want to experiment with or adopt Artificial Intelligence in Moodle in a way that is integrated into the educational workflow, with a focus on student support, teacher productivity, and continuous course improvement.

## Main features

### Virtual assistant in Moodle

The plugin can display a chat bubble on course pages. The assistant uses information from the Moodle environment, such as the course name, the user's language, and the available modules, to provide more contextualized answers.

The chat was designed to act as an educational tutor. It guides students, answers questions about the course, and keeps the focus on the subject content.

### Course-contextualized answers

The assistant's internal prompt considers the course the user is currently browsing. This way, the AI is instructed to respond as a Moodle teacher, keeping the focus on the current course and on the student's language.

This helps avoid generic answers and makes the experience closer to real pedagogical support.

### H5P content creation and management

GeniAI includes an area for creating and managing H5P content with AI support. The goal is to allow teachers and administrators to generate interactive materials based on educational content.

The content types planned in the project include:

* Interactive book;
* Digital book;
* Glossary;
* Flashcards;
* Quizzes;
* Drag-the-words activities;
* Other H5P formats, depending on implementation and availability.

The integration allows users to create, edit, delete, and send content to Moodle's Content Bank.

### Pedagogical activity analysis

The plugin includes resources for analyzing Moodle activities with AI. The analysis considers aspects such as:

* Spelling, grammar, and textual clarity;
* Coherence between the activity title, section, and content;
* Predominant level of Bloom's Taxonomy;
* Pedagogical suitability;
* Practical improvement recommendations.

The analysis can be used by teachers, coordinators, and instructional designers to review activities before or after publication.

### Usage reports

The project records operational metadata related to AI usage, such as the model used, the number of tokens sent, the number of tokens received, and the execution date.

This data helps administrators monitor consumption, usage volume, and approximate costs related to the API.

## How to use

### For students

When the plugin is active and configured, students will see the GeniAI chat on course pages.

Students can:

* Ask questions about the course;
* Receive clear and contextualized answers;
* Continue the conversation while navigating;
* Clear the conversation history when needed;
* Use audio, if the feature is enabled in the environment.

### For teachers and administrators

Users with management permissions can use additional resources, such as:

* Analyze activities with AI;
* View analysis history;
* Create H5P content with AI;
* Manage created H5P content;
* Access usage reports;
* Download reports in CSV format.

## H5P with GeniAI

The H5P feature allows users to create interactive content using AI and send it to Moodle's Content Bank.

Basic flow:

1. Access Moodle's Content Bank area.
2. Open GeniAI's H5P management/creation area.
3. Choose the desired content type.
4. Enter the topic, title, or base content.
5. Generate the content with AI.
6. Review and edit the generated material.
7. Send the H5P to the Content Bank.
8. Use the H5P in a Moodle activity.

Note: part of the H5P generation flow uses an external integration with a support service from the project. Before using it in production, review the institution's privacy, security, and data processing policies.

## Activity analysis with AI

The plugin can analyze Moodle activities to support pedagogical review.

The analysis considers:

* Textual clarity;
* Spelling and grammar;
* Alignment between activity, section, and course;
* Bloom's Taxonomy;
* Pedagogical suitability;
* Practical improvement suggestions.

The AI response is presented in a user-readable format and may also include a technical JSON block for logging and internal processing.

This feature is useful for:

* Reviewing activities before publication;
* Supporting course coordinators;
* Standardizing pedagogical quality;
* Diagnosing activities that are too simple, confusing, or misaligned;
* Continuously improving online courses.

## Reports

GeniAI includes a report area for monitoring AI usage.

Records may include:

* Model used;
* Number of tokens sent;
* Number of tokens received;
* Record creation date;
* Operational metadata from the request;
* Analysis data, when applicable.

The project also includes a route for downloading reports in CSV format, allowing external analysis in spreadsheets or administrative tools.

## Use cases

GeniAI can be used in different educational scenarios:

* Virtual tutor for students in online courses;
* Student support outside human service hours;
* Pedagogical review of activities;
* Fast creation of H5P content;
* Support for teachers in improving materials;
* Administrative monitoring of AI consumption;
* Institutional experimentation with generative AI in Moodle.

## Limitations and precautions

AI can make mistakes, misinterpret context, or generate incomplete answers. Therefore, GeniAI should be treated as a support tool, not as a complete replacement for the teacher, tutor, or pedagogical team.

It is recommended that the institution:

* Guide students on the proper use of AI;
* Review generated content before publishing it;
* Monitor API costs;
* Define clear rules for educational use;
* Avoid sending unnecessary sensitive data;
* Maintain human supervision over important pedagogical decisions.

## License

This plugin follows the Moodle license: GNU GPL v3 or later

## Credits

Project developed by Eduardo Kraus: https://eduardokraus.com

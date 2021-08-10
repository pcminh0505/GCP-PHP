*COSC2638 - Cloud Computing

*RMIT University

*Student name: Pham Cong Minh

*Student ID: s3818102

*Assignment 1: Google Cloud Platform

---

## Deployed Link:

---
## Installation
To begin, install the preferred dependency manager for PHP, [Composer](https://getcomposer.org/).

Now to install just this component:
```
composer install google/cloud-storage
composer installgoogle/cloud-bigquery
composer install google/apiclient
```
---

## Problem 1: CRUD project.csv file with PHP Application

- Upload and access the CSV file on the bucket: gs://pcminh-asm1/project.csv
- Create, Update, Delete methods for project CSV file

### Notes:

#### Data cleaning technique:

- Drop columns ['undefined','undefined.1,'undefined.2']
- Add ID column for better management
- Convert "" or " " value to "N/A"
- Convert excel file (original download) to CSV UTF-8 to keep Vietnamese. Then pass to Notepad++ to remove BOM signature (Encoding UTF-8 Without BOM)

#### Rules:

- Required fields: Project Name, Subtype, Current Status, Country, Province/State, District, Latitude, Longitude, Data Source
- New project will be assign after the latest ID
- For better display, the landing website will only show the required information. There's a button to show other information.

#### File Management:

- home.php: Home page display task 1 first
- action.php: Include all the CRUD method in one file
- form.php: Form view for add, view detail, and edit information
- config.php: Store projectID and path to Google Service

---

## Problem 2: Query project.csv file with Google Big Query (GBQ)

- Upload and access the CSV file on GBQ:
- Display all the project information.
- Allow pagination in the list including: page size, page number, next, previous, first, last page.
  (Default page size is 10).
- Allows to search projects by name.
- Allows to filter projects by countries. There is a select box so users can
  select a country to view all projects belonging to that country.

---

## Problem 3: Customized app with public dataset

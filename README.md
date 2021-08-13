# Mekong Project Management with PHP to Google Cloud

_This is my first assignment in Cloud Computing._

---

## Deployed Link: [Link](https://s3818102-asm1.as.r.appspot.com)

Expired by the end of September

---

## Installation

To begin, install the preferred dependency manager for PHP, [Composer](https://getcomposer.org/).

Require just these components:

```
composer require google/cloud-storage
composer require google/cloud-bigquery
composer require google/apiclient
```
Install components
```
composer install
```

#### Dataset

Please access this [link](https://data.vietnam.opendevelopmentmekong.net/dataset/mekong-infrastructure-tracker/resource/9640d37d-53ca-42fb-83a0-04de89228f1d)

---

## Problem 1: CRUD file with PHP Application

#### Features:

- Upload and access the CSV file on the bucket: [gs://pcminh-asm1/project.csv](#)
- Create, Update, Delete methods for project CSV file

#### Data cleaning technique:

- Drop columns ['undefined','undefined.1,'undefined.2']
- Add ID column for better management
- Convert excel file (original download) to CSV UTF-8 to keep Vietnamese. Then pass to Notepad++ to remove BOM signature (Encoding UTF-8 Without BOM)

#### Rules:

- Required fields: Project Name, Subtype, Current Status, Country, Province/State, District, Latitude, and Longitude.
- New project will be assign after the latest ID
- For better display, the landing website will only show the required information. There's a button to show other information.

#### File Management:

- `index.php`: Control routing
- `home.php`: Home page display task 1 first
- `action.php`: Include all the CRUD method in one file
- `form.php`: Form view for add, view detail, and edit information
- `config.php`: Store projectID and path to Google Service
- `function.php`: Store reusable function for both problem 1 and 2

---

## Problem 2: Query project.csv file with Google Big Query (GBQ)

This problem using BigQuery via Google Client API so that some command and syntax are different from [docs](https://cloud.google.com/bigquery/docs/reference/libraries)

#### Features:

- Upload and access the CSV file on GBQ.
- Display all the project information.
- Allow pagination in the list including: page size, page number, next, previous, first, last page. (Default page size is 10)
- Allows to search projects by name.
- Allows to filter projects by countries by a checkbox.
- Allows user to view more information about the project.

#### File Management:

- `bigquery.php`: Display page for BigQuery task (include pagination and query)

---

## Problem 3: Customized app with public dataset

#### Dataset: [Time Series Music Metadata: ListenBrainz](https://console.cloud.google.com/marketplace/product/metabrainz/listenbrainz)

#### Features:

- Display table with `timestamp`, `username`, `artist`,`album`,`song`,`tags`.
- Able to search with combination of Artist / Album / Song / Tags.
- Report dashboard on top played Artist / Album / Song.
- Search tops 10 song by Artist

#### File management:

- `query.php`: PHP script for querying data
- `dashboard.php`: Show figure report
- `listenbrainz.php`: Show query table

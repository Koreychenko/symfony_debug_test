# ecocode coding test

We have a small application that currently can only show the users a list of movies like IMDB does. 
The final product should contain the whole IMDB database and will give the users the opportunity
to mark their favorites. 




## Setup
If you want to set up the sample project, you can load the fixtures to get some sample data.


## Tasks
suggested time limit for the whole test is between 2-4 hours.

- review/refactor/debug the php files (templates can be ignored) according to your interpretation of clean code
  
  if you have improvements/suggestions that have not been implemented write them down under 
  [further improvements](#markdown-header-further-improvements) 
- Fill the User properties "last_login" and login_count" correctly
- Think about a concept how import over 6 million titles from im db und update them on a daily base



## Results submission
create a new repository with the current code base. commit your changes and send us a link to the repository


## Further improvements
- Filled by you

1. In the IMDb titles are stored in the following format:
titleId
ordering
title
region
language
types
attributes
isOriginalTitle

I recommend to change primary key of Movie table to "titleId" (see https://www.imdb.com/interfaces/). 
This will allow us to insert with ON DUPLICATE KEY UPDATE and prevent MySQL autoincrement field overflow. 

To import/update titles from IMDb best solution to create shell script, which does next operations:
1. downloads title info from (https://datasets.imdbws.com/title.akas.tsv.gz)
    ```
        wget https://datasets.imdbws.com/title.akas.tsv.gz
    ```
2. extract data:
    ```
        gzip -d https://datasets.imdbws.com/title.akas.tsv.gz
    ```
3. import data from file into temporary table
    ```
        CREATE TEMPORARY TABLE temporary_table LIKE movie;
        DROP INDEX `PRIMARY` ON temporary_table;
   
        LOAD DATA INFILE 'title.akas.tsv'
        INTO TABLE temporary_table
        FIELDS TERMINATED BY '\t' OPTIONALLY ENCLOSED BY '"'
        (field1, field2);
        
        INSERT INTO movie
        SELECT * FROM temporary_table
        ON DUPLICATE KEY UPDATE field1 = VALUES(field1), field2 = VALUES(field2);
   
        DROP TEMPORARY TABLE temporary_table;
    ```
   
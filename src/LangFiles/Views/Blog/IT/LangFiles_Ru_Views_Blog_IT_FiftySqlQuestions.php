<?php
class LangFiles_Ru_Views_Blog_IT_FiftySqlQuestions extends LangFiles_Ru_Views_BlogArts
{
    static public function getLangArtContent():\stdClass
    {

        $langArtContent = new stdClass();

        $langArtContent->p = 'Шпаргалка по SQL. Взято с linkedin чтоб всегда держать под рукой '.
            '(<a href="/downloads/SqlCheatSheet.pdf" title="Скачать SqlCheatSheet.pdf" download>Скачать pdf на английском</a>).';

        $langArtContent->q1 = 'Что такое SQL?';
        $langArtContent->a1 = 'SQL - это Структурированный язык запросов. Это язык программирования используемый для управления '.
            'реляционными базами данных.';

        $langArtContent->q2 = 'Что такое база данных?';
        $langArtContent->a2 = 'База данных - это упорядоченный набор данных хранимый и доступный в электронном виде. База данных обеспечивает '.
            'способы хранения, огранизации и доступа к большому количеству данных эффективно';

        $langArtContent->q3 = 'Что такое первичный ключ?';
        $langArtContent->a3 = 'Первичный ключ это столбец или комбинация столбцов которая уникально идентифицирует каждую запись. '.
            'Это лежит в основе обеспечения правила целостности в реляционной базе данных';

        $langArtContent->q4 = 'Что такое внешний ключ?';
        $langArtContent->a4 = 'Внешний ключ это столбец или комбинация столбцов с помощью которого устанавливается свзяь между двумя таблицами. '.
            'Он гарантирует согласованность данных между таблицами';

        $langArtContent->q5 = 'В чём разница между первичным ключом и уникальным?';
        $langArtContent->a5 = 'Первичный ключ используется чтоб уникально определить запись в таблице и должен иметь уникальное значение. '.
            'С другой стороны, уникальный ключ обеспечивает что столбец или комбинация столбцов имеет уникальное значение '.
            'но необязательно определяет уникальность записи';

        $langArtContent->q6 = 'Что такое нормализация?';
        $langArtContent->a6 = 'Нормализация - это процесс организации данных в БД для минимизации избыточности. '.
            'Для это делаю разделение таблицы на несколько меньших таблиц и устанавливают связи между ними';


        $langArtContent->q7 = 'Какие нормальные формы есть и различия между нами?';
        $langArtContent->a7 = 'Выделяют следующие типы нормальных форм:';
        $langArtContent->a71 = 'Первая НФ (1NF)';
        $langArtContent->a72 = 'Вторя НФ (2NF)';
        $langArtContent->a73 = 'Третья НФ (3NF)';
        $langArtContent->a74 = 'Бойс-Кодд НФ (BCNF)';
        $langArtContent->a75 = 'Четвертая НФ (4NF)';
        $langArtContent->a76 = 'Пятая НФ (5NF) или Project-Join НФ (PJNF)';

        $langArtContent->q8 = 'Что такое join в SQL?';
        $langArtContent->a8 = 'join - это оператор для объединения столбцов из двух и более таблиц на основе связей между ними. '.
            'Это дает возможность получать данные из нескольких таблиц одновременно';

        $langArtContent->q9 = 'В чем разница между DELETE и TRUNCATE в SQL?';
        $langArtContent->a9 = 'The DELETE statement is used to remove specific rows from a table based on a condition. '.
            'It can be rolled back and generates individual delete operations for each row. TRUNCATE, on the other '.
            'hand, is used to remove all rows from a table. It cannot be rolled back, and it is faster than DELETE as '.
            'it deallocates the data pages instead of logging individual row deletions';

        $langArtContent->q10 = 'What is the difference between UNION and UNION ALL?';
        $langArtContent->a10 = 'UNION and UNION ALL are used to combine the result sets of two or more SELECT statements. '.
            'UNION removes duplicate rows from the combined result set. whereas UNION ALL includes all rows, including duplicates';

        $langArtContent->q11 = 'What is the difference between the HAVING clause and the WHERE clause?';
        $langArtContent->a11 = 'The WHERE clause is used to filter rows based on a condition before the data is grouped or aggregated. '.
            'It operates on individual rows. The HAVING clause, on the other hand, is used to filter grouped rows '.
            'based on a condition after the data is grouped or aggregated using the GROUP BY clause';

        $langArtContent->q12 = 'What is a transaction in SQL?';
        $langArtContent->a12 = 'A transaction is a sequence of SQL statements that are executed as a single logical unit of work. '.
            'It ensures data consistency and integrity by either committing all changes or rolling them back if '.
            'an error occurs';

        $langArtContent->q13 = 'What is the difference between a clustered and a non-clustered index?';
        $langArtContent->a13 = 'A clustered index determines the physical order of data in a table. It changes the way the data is '.
            'stored on disk and can be created on only one column. A table can have only one clustered index. '.
            'A non-clustered index does not affect the physical order of data in a table. It is stored separately and '.
            'contains a pointer to the actual data. A table can have multiple non-clustered indexes.';

        $langArtContent->q14 = 'What is ACID in the context of database transactions?';
        $langArtContent->a14 = 'ACID stands for Atomicity, Consistency, Isolation, and Durability. It is a set of properties that '.
            'guarantee reliable processing of database transactions.';
        $langArtContent->a141 = 'Atomicity ensures that a transaction is treated as a single unit of work, either all or none of the changes are applied';
        $langArtContent->a142 = 'Consistency ensures that a transaction brings the database from one valid state to another';
        $langArtContent->a143 = 'Isolation ensures that concurrent transactions do not interfere with each other';
        $langArtContent->a144 = 'Durability ensures that once a transaction is committed, its changes are permanent and survive system failures';

        $langArtContent->q15 = 'What is a deadlock?';
        $langArtContent->a15 = 'A deadlock occurs when two or more transactions are waiting for each other to release resources, '.
            'resulting in a circular dependency. As a result, none of the transactions can proceed, and the system may '.
            'become unresponsive';

        $langArtContent->q16 = 'What is the difference between a database and a schema?';
        $langArtContent->a16 = 'A database is a container that holds multiple objects, such as tables, views, indexes, and procedures. '.
            'It represents a logical grouping of related data. A schema, on the other hand, is a container within a database '.
            'that holds objects and defines their ownership. It provides a way to organize and manage database objects.';

        $langArtContent->q17 = 'What is the difference between a temporary table and table variable?';
        $langArtContent->a17 = 'A temporary table is a table that is created and exists only for the duration of a session or a '.
            'transaction. It can be explicitly dropped or is automatically dropped when the session or '.
            'transaction ends. A table variable is a variable that can store a tablelike structure in memory. It has a '.
            'limited scope within a batch, stored procedure, or function. It is automatically deallocated when the '.
            'scope ends';

        $langArtContent->q18 = 'What is the purpose of the GROUP BY clause?';
        $langArtContent->a18 = 'The GROUP BY clause is used to group rows based on one or more columns in a table. It is typically '.
            'used in conjunction with aggregate functions, such as SUM, AVG, COUNT, etc., to perform calculations on grouped data';

        $langArtContent->q19 = 'What is the difference between CHAR and VARCHAR data types?';
        $langArtContent->a19 = 'CHAR is a fixed-length string data type, while VARCHAR is a variable-length string data type';

        $langArtContent->q20 = 'What is a stored procedure?';
        $langArtContent->a20 = 'A stored procedure is a set of SQL statements that are stored in the database and can be executed '.
            'repeatedly. It provides code reusability and better performance';

        $langArtContent->q21 = 'What is a subquery?';
        $langArtContent->a21 = 'A subquery is a query nested inside another query. It is used to retrieve data based on the result of an inner query';

        $langArtContent->q22 = 'What is a view?';
        $langArtContent->a22 = 'A view is a virtual table based on the result of an SQL statement. It allows users to retrieve and manipulate data';

        $langArtContent->q23 = 'What is the difference between a cross join and an inner join?';
        $langArtContent->a23 = 'A cross join (Cartesian product) returns the combination of all rows from two or more tables. '.
            'An inner join returns only the matching rows based on a join condition';

        $langArtContent->q24 = 'What is the purpose of the COMMIT statement?';
        $langArtContent->a24 = 'The COMMIT statement is used to save changes made in a transaction permanently. It ends the transaction '.
            'and makes the changes visible to other users';

        $langArtContent->q25 = 'What is the purpose of the ROLLBACK statement?';
        $langArtContent->a25 = 'The ROLLBACK statement is used to undo changes made in a transaction. It reverts the database to its '.
            'previous state before the transaction started';

        $langArtContent->q26 = 'What is the purpose of the NULL value in SQL?';
        $langArtContent->a26 = 'NULL represents the absence of a value or unknown value. It is different from zero or an empty string '.
            'and requires special handling in SQL queries';

        $langArtContent->q27 = 'What is the difference between a view and a materialized view?';
        $langArtContent->a27 = 'A materialized view is a physical copy of the view s result set stored in the database, which is '.
            'updated periodically. It improves query performance at the cost of data freshness';

        $langArtContent->q28 = 'What is a correlated subquery?';
        $langArtContent->a28 = 'A correlated subquery is a subquery that refers to a column from the outer query. It executes once '.
            'for each row processed by the outer query';

        $langArtContent->q29 = 'What is the purpose of the DISTINCT keyword?';
        $langArtContent->a29 = 'The DISTINCT keyword is used to retrieve unique values from a column or combination of columns in a SELECT statement';

        $langArtContent->q30 = 'What is the difference between the CHAR and VARCHAR data types?';
        $langArtContent->a30 = 'CHAR stores fixed-length character strings, while VARCHAR stores variable-length character strings. '.
            'The storage size of CHAR is constant, while VARCHAR adjusts dynamically';

        $langArtContent->q31 = 'What is the difference between the IN and EXISTS operators?';
        $langArtContent->a31 = 'The IN operator checks for a value within a set of values or the result of a subquery. The EXISTS '.
            'operator checks for the existence of rows returned by a subquery';

        $langArtContent->q32 = 'What is the purpose of the TRIGGER statement?';
        $langArtContent->a32 = 'The TRIGGER statement is used to associate a set of SQL statements with a specific event in the '.
            'database. It is executed automatically when the event occurs';

        $langArtContent->q33 = 'What is the difference between a unique constraint and a unique index?';
        $langArtContent->a33 = 'A unique constraint ensures the uniqueness of values in one or more columns, while a unique index '.
            'enforces the uniqueness and also improves query performance';

        $langArtContent->q34 = 'What is the purpose of the TOP or LIMIT clause?';
        $langArtContent->a34 = 'The TOP (in SQL Server) or LIMIT (in MySQL) clause is used to limit the number of rows returned by '.
            'a query. It is often used with an ORDER BY clause';

        $langArtContent->q35 = 'What is the difference between the UNION and JOIN operators?';
        $langArtContent->a35 = 'UNION combines the result sets of two or more SELECT statements vertically, while JOIN combines '.
            'columns from two or more tables horizontally based on a join condition';

        $langArtContent->q36 = 'What is a data warehouse?';
        $langArtContent->a36 = 'A data warehouse is a large, centralized repository that stores and manages data from various sources. '.
            'It is designed for efficient reporting, analysis, and business intelligence purposes';

        $langArtContent->q37 = 'What is the difference between a primary key and a candidate key?';
        $langArtContent->a37 = 'A primary key is a chosen candidate key that uniquely identifies a row in a table. '.
            'A candidate key is a set of one or more columns that could potentially become the primary key';

        $langArtContent->q38 = 'What is the purpose of the GRANT statement?';
        $langArtContent->a38 = 'The GRANT statement is used to grant specific permissions or privileges to users or roles in a database';

        $langArtContent->q39 = 'What is a correlated update?';
        $langArtContent->a39 = 'A correlated update is an update statement that refers to a column from the same table in a subquery. '.
            'It updates values based on the result of the subquery for each row';

        $langArtContent->q40 = 'What is the purpose of the CASE statement?';
        $langArtContent->a40 = 'The CASE statement is used to perform conditional logic in SQL queries. It allows you to return '.
            'different values based on specified conditions';

        $langArtContent->q41 = 'What is the purpose of the COALESCE function?';
        $langArtContent->a41 = 'The COALESCE function returns the first non-null expression from a list of expressions. It is often '.
            'used to handle null values effectively';

        $langArtContent->q42 = 'What is the purpose of the ROW_NUMBER() function?';
        $langArtContent->a42 = 'The ROW_NUMBER() function assigns a unique incremental number to each row in the result set. '.
            'It is commonly used for pagination or ranking purposes.ll values effectively';

        $langArtContent->q43 = 'What is the difference between a natural join and an inner join?';
        $langArtContent->a43 = 'A natural join is an inner join that matches rows based on columns with the same name in the joined '.
            'tables. It is automatically determined by the database';

        $langArtContent->q44 = 'What is the purpose of the CASCADE DELETE constraint?';
        $langArtContent->a44 = 'The CASCADE DELETE constraint is used to automatically delete related rows in child tables when a row '.
            'in the parent table is deleted';

        $langArtContent->q45 = 'What is the purpose of the ALL keyword in SQL?';
        $langArtContent->a45 = 'The ALL keyword in SQL is used in conjunction with comparison operators (like =, >, <, >=, <=, !=) to '.
            'compare a value against all values in a subquery';

        $langArtContent->q46 = 'What is the difference between the EXISTS and NOT EXISTS operators?';
        $langArtContent->a46 = 'The EXISTS operator returns true if a subquery returns any rows, while the NOT EXISTS operator returns '.
            'true if a subquery returns no rows';

        $langArtContent->q47 = 'What is the purpose of the CROSS APPLY operator?';
        $langArtContent->a47 = 'The CROSS APPLY operator is used to invoke a tablevalued function for each row of a table expression. '.
            'It returns the combined result set';

        $langArtContent->q48 = 'What is a self-join?';
        $langArtContent->a48 = 'A self-join is a join operation where a table is joined with itself. It is useful when you want to '.
            'compare rows within the same table based on related columns. It requiresbined result set';

        $langArtContent->q49 = 'What is an ALIAS command?';
        $langArtContent->a49 = 'ALIAS command in SQL is the name that can be given to any table or a column. This alias name can be '.
            'referred in WHERE clause to identify a particular table or a column';

        $langArtContent->q50 = 'Why are SQL functions used?';
        $langArtContent->a50 = 'SQL functions are used for the following purposes:';
        $langArtContent->a501 = 'To perform some calculations on the data';
        $langArtContent->a502 = 'To modify individual data items';
        $langArtContent->a503 = 'To manipulate the output';
        $langArtContent->a504 = 'To format dates and numbers';
        $langArtContent->a505 = 'To convert the data types';

        return $langArtContent;
    }
}

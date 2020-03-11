# Todo List
This is an app I built to gain experience using PHP and the Symfony framework.

[Check it out on Heroku](https://symfony-todo-list.herokuapp.com/)

## Functionality
The app will allow a user to create 'Tasks' which are automatically created with the status: "Incomplete". 

The user can view all of their tasks in the task index page. Tasks here are separated into two categories, *Complete* and *Incomplete*.

The user can visit an individual task's show page by clicking on its name from the task index page. 

The user can change an incomplete task's status to *Complete* from the index page or from the show page for that particular 
task. A task cannot be marked *Incomplete* by a user.

The user can create additional tasks from any page of the app.

## Tech Stack
**PHP** | **Symfony** | **Doctrine** | **Twig** | **PostgreSQL** | **Apache** | **Heroku**

## Schema
The PostgreSQL database has one table with two columns:

#### Todo table
| id | task      | status     |
| ---|:---------:| ----------:|
| 1  | Call Mom  | Incomplete |
| 2  | Meal Prep | Complete   |


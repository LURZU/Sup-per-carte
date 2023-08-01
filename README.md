# Sup'per Card Project
![Sup'perform Logo](https://www.sup-perform.fr/wp-content/uploads/2022/03/logo-supperform.png)

The Sup'per Card project was carried out for the preparatory school Sup'perform in Montpellier. The goal of the project is to create a tool allowing students to review their courses using flashcards.
This project was developed during my work-study year at Defacto in Narbonne.

## Installation

Follow these steps to set up the project on your local machine.

1. **Clone the Repository**

    First, clone the repository to your local machine:

    ```bash
    git clone https://github.com/your-github-username/your-repo-name.git
    ```

2. **Install Composer Dependencies**

    Navigate to the project root in your terminal and run the following command to install the Composer dependencies:

    ```bash
    cd your-repo-name
    composer install
    ```

3. **Install NPM Dependencies**

    Still in the project root, install the NPM dependencies:

    ```bash
    npm install
    ```

4. **Configure your Environment**

    Duplicate the `.env.example` file in the project root and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

    Open the `.env` file and set the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` environment variables to match the credentials of your database.

5. **Generate an Application Key**

    Laravel requires you to have an app encryption key which is generally randomly generated and stored in your `.env` file. You can run the following command to generate this key:

    ```bash
    php artisan key:generate
    ```

6. **Run Migrations**

    Lastly, run the following command in your terminal to run database migrations:

    ```bash
    php artisan migrate
    ```

7. **Start the Server**

    Now you are ready to start the server:

    ```bash
    php artisan serve
    ```

    Now, you should be able to access the application via [http://localhost:8000](http://localhost:8000).

Please note that this is a basic setup. Depending on your application, you may need to run additional commands or configure additional components such as a queue worker or a task scheduler.


## Technologies Used
This project was built using the following technologies:

### Laravel
![Laravel Logo](https://th.bing.com/th?id=OSK.b0ba6d0d7144a425934b9f2daab2b971&w=148&h=148&c=7&o=6&dpr=1.1&pid=SANGAM)

Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony.

### Livewire
![Livewire Logo](https://th.bing.com/th/id/R.738656faed42db7f72e2ac0068886808?rik=ePdq1WB7kGHrlw&pid=ImgRaw&r=0)

Livewire is a full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.

### MariaDB
![MariaDB Logo](https://th.bing.com/th/id/R.bc16e0cfc6867a704ce97ee891c61a4c?rik=D61tHDy7QoPLrg&pid=ImgRaw&r=0)

MariaDB is a community-developed, commercially supported fork of the MySQL relational database management system (RDBMS), intended to remain free and open-source software under the GNU General Public License.

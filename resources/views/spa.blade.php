<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- Подключаем Bootstrap, чтобы не работать над дизайном проекта -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <div class="container mt-5">
            <h1>Список книг нашей библиотеки</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Наличие</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books" class="book">
                        <th scope="row">@{{book.id}}</th>
                        <td>@{{book.title}}</td>
                        <td>@{{book.author}}</td>
                        <td>
                            <button v-if="book.availability==1" type="button" class="btn btn-outline-primary" v-on:click="changeBookAvailability(book.id)">
                                Доступна
                            </button>
                            <button v-else type="button" class="btn btn-outline-primary" v-on:click="changeBookAvailability(book.id)">
                                Выдана
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-danger" v-on:click="deleteBook(book.id)">
                                Удалить
                            </button>
                        </td>
                    </tr>

                    <!-- Строка с полями для добавления новой книги -->
                    <tr>
                        @csrf
                        <th scope="row">Добавить</th>
                        <td><input type="text" v-model="title"  class="form-control"></td>
                        <td><input type="text" v-model="author" class="form-control"></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-outline-success" v-on:click="addBook">
                                Добавить
                            </button>
                        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--Подключаем axios для выполнения запросов к api -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <!--Подключаем Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>

    <script>
        let vm = new Vue({
            el: '#app',
            data() {
              return{
                  books:null,
                  title:null,
                  author:null,
             
                  }
            },
            methods: {
                loadBookList(){
                    axios.get('/api/book/all')  .then((response) => {
                    this.books = response.data;
                   
                     })
                },
                addBook(){
                    axios.post('/api/book/add',{
                        title: this.title,
                        author:this.author
                    }),
                
                    axios.get('/api/book/all')  .then((response) => {
                    this.books = response.data;
             
                     }) 
                    },
                deleteBook(id){
                    axios.get('/api/book/delete/'+id),
                    axios.get('/api/book/all')  .then((response) => {
                    this.books = response.data;
           
                     })
                
                      
                },
                changeBookAvailability(id){
                    axios.get('/api/book/change_availabilty/'+id),
                    axios.get('/api/book/all')  .then((response) => {
                    this.books = response.data;
                 
                     }) 
                }
            },
            mounted(){
                // Сразу после загрузки страницы подгружаем список книг и отображаем его
                this.loadBookList();
            }
        });
        
    </script>
</body>
</html>
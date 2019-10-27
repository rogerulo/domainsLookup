<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    
    <title><?php echo e(config('app.name', 'Dev Site')); ?> - Domain Searching</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style type="text/css">
        .navbar-nav .dropdown-menu {
            position: absolute;
            float: none;
        }

        a{
            color: #181919;
        }
    </style>


    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">


    <!-- <?php echo $__env->yieldPushContent('styles'); ?> -->

    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


</head>

<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<!-- <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div> -->
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

    <div class="page-wrapper">
        <div class="container-fluid">


        <section class="todoapp">
            <header class="header">
                <h1>todos</h1>
                <input class="new-todo"
                autofocus autocomplete="off"
                placeholder="What needs to be done?"
                v-model="newTodo"
                @keyup.enter="addTodo">
            </header>
            <section class="main" v-show="todos.length" v-cloak>
                <input id="toggle-all" class="toggle-all" type="checkbox" v-model="allDone">
                <label for="toggle-all"></label>
                <ul class="todo-list">
                <li v-for="todo in filteredTodos"
                    class="todo"
                    :key="todo.id"
                    :class="{ completed: todo.completed, editing: todo == editedTodo }">
                    <div class="view">
                    <input class="toggle" type="checkbox" v-model="todo.completed">
                    <label @dblclick="editTodo(todo)"><?php echo e(todo.title); ?></label>
                    <button class="destroy" @click="removeTodo(todo)"></button>
                    </div>
                    <input class="edit" type="text"
                    v-model="todo.title"
                    v-todo-focus="todo == editedTodo"
                    @blur="doneEdit(todo)"
                    @keyup.enter="doneEdit(todo)"
                    @keyup.esc="cancelEdit(todo)">
                </li>
                </ul>
            </section>
            <footer class="footer" v-show="todos.length" v-cloak>
                <span class="todo-count">
                <strong><?php echo e(remaining); ?></strong> <?php echo e(remaining | pluralize); ?> left
                </span>
                <ul class="filters">
                <li><a href="#/all" :class="{ selected: visibility == 'all' }">All</a></li>
                <li><a href="#/active" :class="{ selected: visibility == 'active' }">Active</a></li>
                <li><a href="#/completed" :class="{ selected: visibility == 'completed' }">Completed</a></li>
                </ul>
                <button class="clear-completed" @click="removeCompleted" v-show="todos.length > remaining">
                Clear completed
                </button>
            </footer>
            </section>
            <footer class="info">
            <p>Double-click to edit a todo</p>
            <p>Written by <a href="http://evanyou.me">Evan You</a></p>
            <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
            </footer>


        </div>
    </div>
</div>



<script type="text/javascript">
        // Full spec-compliant TodoMVC with localStorage persistence
        // and hash-based routing in ~120 effective lines of JavaScript.


        // visibility filters
        var filters = {
        all: function (todos) {
            return todos
        },
        active: function (todos) {
            return todos.filter(function (todo) {
            return !todo.completed
            })
        },
        completed: function (todos) {
            return todos.filter(function (todo) {
            return todo.completed
            })
        }
        }

        // app Vue instance
        var app = new Vue({
        // app initial state
        data: {
            todos: [],
            newTodo: '',
            editedTodo: null,
            visibility: 'all'
        },

        // watch todos change for localStorage persistence
        watch: {
            todos: {
            handler: function (todos) {
                todoStorage.save(todos)
            },
            deep: true
            }
        },

        // computed properties
        // http://vuejs.org/guide/computed.html
        computed: {
            filteredTodos: function () {
            return filters[this.visibility](this.todos)
            },
            remaining: function () {
            return filters.active(this.todos).length
            },
            allDone: {
            get: function () {
                return this.remaining === 0
            },
            set: function (value) {
                this.todos.forEach(function (todo) {
                todo.completed = value
                })
            }
            }
        },

        filters: {
            pluralize: function (n) {
            return n === 1 ? 'item' : 'items'
            }
        },

        // methods that implement data logic.
        // note there's no DOM manipulation here at all.
        methods: {
            addTodo: function () {
            var value = this.newTodo && this.newTodo.trim()
            if (!value) {
                return
            }
            this.todos.push({
                id: todoStorage.uid++,
                title: value,
                completed: false
            })
            this.newTodo = ''
            },

            removeTodo: function (todo) {
            this.todos.splice(this.todos.indexOf(todo), 1)
            },

            editTodo: function (todo) {
            this.beforeEditCache = todo.title
            this.editedTodo = todo
            },

            doneEdit: function (todo) {
            if (!this.editedTodo) {
                return
            }
            this.editedTodo = null
            todo.title = todo.title.trim()
            if (!todo.title) {
                this.removeTodo(todo)
            }
            },

            cancelEdit: function (todo) {
            this.editedTodo = null
            todo.title = this.beforeEditCache
            },

            removeCompleted: function () {
            this.todos = filters.active(this.todos)
            }
        },

        // a custom directive to wait for the DOM to be updated
        // before focusing on the input field.
        // http://vuejs.org/guide/custom-directive.html
        directives: {
            'todo-focus': function (el, binding) {
            if (binding.value) {
                el.focus()
            }
            }
        }
        })

        // handle routing
        function onHashChange () {
        var visibility = window.location.hash.replace(/#\/?/, '')
        if (filters[visibility]) {
            app.visibility = visibility
        } else {
            window.location.hash = ''
            app.visibility = 'all'
        }
        }

        window.addEventListener('hashchange', onHashChange)
        onHashChange()

        // mount
        app.$mount('.todoapp')
</script>

</body>

</html>
<?php /**PATH /Users/rogerrojasramirez/PhpstormProjects/dinosaurTest/resources/views/home.blade.php ENDPATH**/ ?>
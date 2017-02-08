
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        users: [],
        user: {},
        paging: {},
        querySearch: ''
    },
    created() {
        this.getUser();
    },
    methods: {
        getUser(url = '/user') {
            if (this.querySearch != '') {
                if (url == '/user') {
                    url += '?';
                } else {
                    url += '&';
                }
                url += 'search=' + this.querySearch;
            }
            this.$http.get(url).then(response => {
                this.users = response.body.data;
                _.unset(response.body, 'data');
                this.paging = response.body;
            });
        },
        findUser(id) {
            this.$http.get(`/user/${id}`).then(response => {
                this.user = response.body;
            });
        },
        createUser() {
            this.$http.post(`/user/`, this.user).then(response => {

            }, response => {
                console.log(response.body);
            });
        },
        updateUser() {
        	this.$http.put('/user/' + this.user.id, this.user).then(response => {

        	}, response => {
                console.log('ERROR: ');
        		console.log(response.body);
        	});
        },
        deleteUser(id) {
            if (! confirm('Delete this user ?')) return;
            this.$http.delete(`user/${id}`).then(response => {
                this.getUser();
            }, response => {
                console.log('ERROR: ');
                console.log(response.body);
            });
        },
        showEditModal(id) {
        	this.findUser(id);
        	$('#editModal').modal('show');
        },
        showCreateModal() {
            this.user = {};
            $('#createModal').modal('show');
        },
        update() {
            if (this.user.password == '') {
                _.unset(this.user, 'password');
            }
        	this.updateUser();
            alert('Success update user');
            this.getUser();
            $('#editModal').modal('hide');
        },
        create() {
            this.createUser();
            alert('Success create new user');
            this.getUser();
            $('#createModal').modal('hide');
        }
    }
});

'use strict';

var app = new Vue({
    el: '#app',
    data: {
        users: [],
        page: 1,
        perPage: 4,
        totalPages: 1,
        usersListClasses: 'tile',
        paginationLinkClass: 'pagination-link',
        isCurrentClass: 'is-current'
    },
    mounted: function mounted() {
        this.fetchUsers();
    },

    methods: {
        nextPage: function nextPage() {
            if (this.page < this.totalPages) {
                this.page++;
                this.fetchUsers();
            }
        },
        prevPage: function prevPage() {
            if (this.page > 1) {
                this.page--;
                this.fetchUsers();
            }
        },
        goToPage: function goToPage(no) {
            if (no <= this.totalPages) {
                this.page = no;
                this.fetchUsers();
            }
        },
        isCurrentPage: function isCurrentPage(button) {
            return button === this.page;
        },
        loader: function loader(toggle) {
            if (toggle) {
                this.usersListClasses = 'tile element is-loading';
                return;
            }
            this.usersListClasses = 'tile';
        },
        fetchUsers: function fetchUsers() {
            var _this = this;

            this.loader(true);
            axios.get('/api/users?page=' + this.page + '&per_page=' + this.perPage).then(function (response) {
                _this.users = response.data.users;
                _this.totalPages = response.data.metadata.total_pages;
                _this.loader(false);
            });
        }
    }
});
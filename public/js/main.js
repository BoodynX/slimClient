'use strict';

var FIRST_PAGE = 1;
var USERS_PER_PAGE = 5;
var TOTAL_PAGES_ON_LOAD = 1;

var app = new Vue({
    el: '#app',
    data: {
        users: [],
        page: FIRST_PAGE,
        perPage: USERS_PER_PAGE,
        totalPages: TOTAL_PAGES_ON_LOAD,
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
            if (this.page > FIRST_PAGE) {
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
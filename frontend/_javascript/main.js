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
    mounted() {
        this.fetchUsers();
    },
    methods: {
        nextPage() {
            if (this.page < this.totalPages) {
                this.page++;
                this.fetchUsers();
            }
        },
        prevPage() {
            if (this.page > 1) {
                this.page--;
                this.fetchUsers();
            }
        },
        goToPage(no) {
            if (no <= this.totalPages) {
                this.page = no;
                this.fetchUsers();
            }
        },
        isCurrentPage(button) {
            return button === this.page;
        },
        loader(toggle){
            if (toggle) {
                this.usersListClasses = 'tile element is-loading';
                return;
            }
            this.usersListClasses = 'tile';
        },
        fetchUsers() {
            this.loader(true);
            axios.get(
                '/api/users?page='+this.page+'&per_page='+this.perPage
            ).then(response => {
                this.users = response.data.users;
                this.totalPages = response.data.metadata.total_pages;
                this.loader(false);
            });
        }
    }
});
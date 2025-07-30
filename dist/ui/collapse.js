window.$stm.collapse = (id, config) => {
    return {
        id: id,
        type: 'collapse',
        state: config.state,
        init() {
            $stm.register(this);
        },
        open(id = '') {
            if (id) {
                (this.id == id) ?
                this.state = true: '';
            } else {
                this.state = true;
            }

        },
        close(id) {
            if (id) {
                (this.id == id) ? this.state = false: '';
            } else {
                this.state = false;
            }

        },
        toggle(id) {
            if (id) {
                (this.id == id) ? this.state = !this.state: '';
            } else {
                this.state = !this.state;
            }
        },
        getState() {
            return this.state;
        },
        getId() {
            return this.id;
        }
    }
}
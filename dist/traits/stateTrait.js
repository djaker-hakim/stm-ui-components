export const stateTrait = {
    open(obj = '') {
        if (obj) {
            (this.id == obj.id || this.ref == obj.ref) ? this.state = true : '';
        } else {
            this.state = true;
        }
    },
    close(obj = '') {
        if (obj) {
            (this.id == obj.id || this.ref == obj.ref) ? this.state = false : '';
        } else {
            this.state = false;
        }
    },
    toggle(obj = '') {
        if (obj) {
            (this.id == obj.id || this.ref == obj.ref) ? this.state = !this.state : '';
        } else {
            this.state = !this.state;
        }
    },
    getState() {
        return this.state;
    },
}

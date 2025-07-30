window.$stm.alert = (id, config) => {
    return {
        id: id,
        type: 'alert',
        state: config.state,
        content: config.content,
        mode: config.mode,
        init() {
            $stm.register(this);
        },
        setContent(content, mode){
            this.mode = mode;
            this.content = content;
        },
        error(content){
            this.setContent(content, 'error');
            return this;
        },
        info(content){
            this.setContent(content, 'info');
            return this;
        },
        warn(content){
            this.setContent(content, 'warning');
            return this;
        },
        success(content){
            this.setContent(content, 'success');
            return this;
        },
        openTmp(duration = 4000){
            this.open()
            const alert = setTimeout(() => {
                this.close();
            }, duration);
        },
        open(id = '') {
            if (id) {
                this.id == id ? this.state = true : '';
            } else {
                this.state = true;
            }
        },
        close(id = '') {
            if (id) {
                this.id == id ? this.state = false : '';
            } else {
                this.state = false;
            }
        },
        toggle(id = '') {
            if (id) {
                this.id == id ? this.state = !this.state : '';
            } else {
                this.state = !this.state;
            }
        },
        getstate() {
            return this.state;
        },
        getId() {
            return this.id;
        },
        getType() {
            return this.type;
        }
    }
}
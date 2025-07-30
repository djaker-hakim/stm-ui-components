window.$stm.progressBar = (id, config) => {
    return {
        id: id,
        type: 'progressbar',
        lable:'',
        progress: 0,
        target: 0,
        duration: config.duration,
        interval: null,
        init(){
            $stm.register(this);
            this.setProgress(config.progress);
        },
        validateProgress(value){
            if(isNaN(Number(value))) return 0;
            value = Number(value);
            value = value < 0 ? 0 : value;
            value = value > 100 ? 100 : value;
            return value;
        },
        setProgress(value) {
            if (value == 'infinite') {
                this.progress = -1;
                return;
            }
            value = this.validateProgress(value);
            if (this.progress > value) this.progress = 0;
            this.target = value;
            clearInterval(this.interval);
            this.interval = setInterval(() => {
                if(this.progress >= this.target) {
                    clearInterval(this.interval);
                    return;
                }
                this.progress += 1;
            }, this.duration); // ~60fps
        },
        setLable(value) {
            this.lable = value;
        },
        setDuration(value) {
            this.duration = value;
        },
        getId() {
            return this.id;
        },
        getType() {
            return this.type;
        },
    };
}
import { stateTrait } from "../traits/stateTrait";

window.$stm.alert = (id, config) => {
    return {
        id: id,
        type: 'alert',
        state: config.state,
        ...stateTrait,
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
    }
}
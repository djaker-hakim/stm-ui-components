import { stateTrait } from "../traits/stateTrait";

window.$stm.collapse = (id, config) => {
    return {
        id: id,
        type: 'collapse',
        state: config.state,
        ...stateTrait,
        init() {
            $stm.register(this);
            window.addEventListener('open-collapse', (e) => this.open(e.detail.id));
            window.addEventListener('close-collapse', (e) => this.close(e.detail.id));
            window.addEventListener('toggle-collapse', (e) => this.toggle(e.detail.id));
        },
    }
}
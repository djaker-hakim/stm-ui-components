import { stateTrait } from "../traits/stateTrait";
import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.collapse = (id, config) => {
    return {
        ...stmInitTrait,
        id: id,
        type: 'collapse',
        state: config.state,
        ...stateTrait,
        init() {
            this.stmInit();
            window.addEventListener('open-collapse', (e) => this.open(e.detail));
            window.addEventListener('close-collapse', (e) => this.close(e.detail));
            window.addEventListener('toggle-collapse', (e) => this.toggle(e.detail));
        },
    }
}
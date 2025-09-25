import { stateTrait } from '../traits/stateTrait'
import { clickOutsideTrait } from '../traits/clickoutsideTrait';

window.$stm.modal = (id, config) => {
    return {
        id: id,
        state: config.state,
        ...stateTrait,
        clickOutside: config.clickOutside,
        ...clickOutsideTrait,
        init() {
            $stm.register(this);
            window.addEventListener('open-modal', (e) => this.open(e.detail.id));
            window.addEventListener('close-modal', (e) => this.close(e.detail.id));
            window.addEventListener('toggle-modal', (e) => this.toggle(e.detail.id));
        }  
    }
}
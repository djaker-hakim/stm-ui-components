import { stateTrait } from '../traits/stateTrait'
import { clickOutsideTrait } from '../traits/clickoutsideTrait';

window.$stm.dropdown = (id, config) => {
    return {
        id: id,
        type: 'dropdown',
        state: config.state,
        ...stateTrait,
        clickOutside: config.clickOutside,
        ...clickOutsideTrait,
        init() {
            $stm.register(this);
             window.addEventListener('open-dropdown', (e) => this.open(e.detail.id));
            window.addEventListener('close-dropdown', (e) => this.close(e.detail.id));
            window.addEventListener('toggle-dropdown', (e) => this.toggle(e.detail.id));
        },
    }
}
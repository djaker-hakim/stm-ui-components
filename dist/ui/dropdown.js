import { stateTrait } from '../traits/stateTrait'
import { clickOutsideTrait } from '../traits/clickoutsideTrait';
import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.dropdown = (id, config) => {
    return {
        ...stmInitTrait,
        id: id,
        type: 'dropdown',
        state: config.state,
        ...stateTrait,
        clickOutside: config.clickOutside,
        ...clickOutsideTrait,
        init() {
            this.stmInit();
            window.addEventListener('open-dropdown', (e) => this.open(e.detail));
            window.addEventListener('close-dropdown', (e) => this.close(e.detail));
            window.addEventListener('toggle-dropdown', (e) => this.toggle(e.detail));
        },
    }
}
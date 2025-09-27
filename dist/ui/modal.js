import { stateTrait } from '../traits/stateTrait'
import { clickOutsideTrait } from '../traits/clickoutsideTrait';
import { stmInitTrait } from '../traits/stmInitTrait';

window.$stm.modal = (id, config) => {
    return {
        ...stmInitTrait,
        id: id,
        state: config.state,
        ...stateTrait,
        clickOutside: config.clickOutside,
        ...clickOutsideTrait,
        init() {
            this.stmInit();
            window.addEventListener('open-modal', (e) => this.open(e.detail));
            window.addEventListener('close-modal', (e) => this.close(e.detail));
            window.addEventListener('toggle-modal', (e) => this.toggle(e.detail));
        }  
    }
}
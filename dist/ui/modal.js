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
        }  
    }
}
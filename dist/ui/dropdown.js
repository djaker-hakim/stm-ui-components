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
        },
    }
}
import { stateTrait } from "../traits/stateTrait";

window.$stm.collapse = (id, config) => {
    return {
        id: id,
        type: 'collapse',
        state: config.state,
        ...stateTrait,
        init() {
            $stm.register(this);
        },
    }
}
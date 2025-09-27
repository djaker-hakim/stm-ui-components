import { refTrait } from "./refTrait";

export const stmInitTrait = {

    ...refTrait,
    stmInit(){
        this.setRef();
        $stm.register(this);
    }
}
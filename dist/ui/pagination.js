import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.pagination = (id, config) =>
{
    return {
        ...stmInitTrait,
        id: id,
        currentPage: config.currentPage,
        totalPages: config.pages,
        pages: [],
        start: null,
        end: null,
        limit: config.limit,
        init(){
            this.stmInit();
            this.visiblePages();
        },
        next(){
            if(this.currentPage < this.totalPages){
                this.currentPage++;
                this.visiblePages();
                this.sendEvent(); 
            }
        },
        prev(){
            if(this.currentPage > 1){
                this.currentPage--;
                this.visiblePages();
                this.sendEvent();
            }
        },
        selectPage(page){
            this.currentPage = page;
            this.visiblePages();
            this.sendEvent();
        },
        visiblePages(){
            this.pages = [];
            this.start = Math.max(1, this.currentPage - Math.floor(this.limit / 2));
            this.end = Math.min(this.totalPages, this.start + this.limit - 1);
            this.start = Math.max(1, this.end - this.limit + 1);
            for(let i = this.start; i <= this.end; i++){
                this.pages.push(i);
            }
        },
        setLimit(value){
            this.limit = value;
            this.visiblePages();
        },
        setTotalPages(value){
            this.totalPages = value;
            this.visiblePages();
        },
        sendEvent(){
            this.$dispatch('change-page', { id: this.id, page: this.currentPage });
        }
    }
}
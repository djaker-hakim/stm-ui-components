@props([
    'tailwindcss' => false,
    'alpinejs' => true,
    'animatecss' => true,
])
@if ($tailwindcss)
    <!-- TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endif

@if ($animatecss)
    <!-- animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endif

@if ($alpinejs)
    <!-- ALPINEJS PLUGIN CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <!-- ALPINEJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endif

<script>
    window.$stm = {
        list: [],
        register(component) {
            this.list.push(component)
        },
        unregister(id) {
            this.list = this.list.filter(item => item.id != id)
        },
        component(id) {
            return this.list.find(item => item.id == id)
        },
        allComponents() {
            return this.list
        },
        open(id){
            this.component(id).open();
        },
        close(id){
            this.component(id).close();
        },
        toggle(id){
            this.component(id).toggle();
        }
    };

    // COMPONENTS FORMS FUNCTIONS
    
        function errorFn(id, message)
        {
            return {
                id: id,
                message: message,
                init(){
                    $stm.register(this);
                },
                setMessage(message){
                    this.message = message;
                },
                reset(){
                    this.message = '';
                }
            }
        }
        function passwordFn(id, config)
        {
            return {
                id: id,
                type: 'password',
                state: config.state,
                showButton: config.showButton,
                init(){
                    $stm.register(this);
                },
                show(){
                    this.state = true;
                },
                hide(){
                    this.state = false;
                },
                toggle(){
                    this.state = !this.state;
                }
            }
        }
        function selectFn(id, options, selected = '')
        {
            return {
                id: id,
                type: 'select',
                options: [],
                selected: '',
                init() {
                    $stm.register(this)
                    this.options = options;
                    selected ? this.selected = selected : '';
                },
                getSelected(){
                    return this.selected;
                },
                getId(){
                    return this.id;
                }

            }
        }

    // COMPONENTS UI FUNCTION

    function alertFn(id, config) {
            return {
                id: id,
                type: 'alert',
                state: config.state,
                content: config.content,
                mode: config.mode,
                init() {
                    $stm.register(this);
                },
                setContent(content, mode){
                    this.mode = mode;
                    this.content = content;
                },
                error(content){
                    this.setContent(content, 'error');
                    return this;
                },
                info(content){
                    this.setContent(content, 'info');
                    return this;
                },
                warn(content){
                    this.setContent(content, 'warning');
                    return this;
                },
                success(content){
                    this.setContent(content, 'success');
                    return this;
                },
                openTmp(duration = 4000){
                    this.open()
                    const alert = setTimeout(() => {
                        this.close();
                    }, duration);
                },
                open(id = '') {
                    if (id) {
                        this.id == id ? this.state = true : '';
                    } else {
                        this.state = true;
                    }
                },
                close(id = '') {
                    if (id) {
                        this.id == id ? this.state = false : '';
                    } else {
                        this.state = false;
                    }
                },
                toggle(id = '') {
                    if (id) {
                        this.id == id ? this.state = !this.state : '';
                    } else {
                        this.state = !this.state;
                    }
                },
                getstate() {
                    return this.state;
                },
                getId() {
                    return this.id;
                },
                getType() {
                    return this.type;
                }
            }
        }
        function collapseFn(id, config) {
            return {
                id: id,
                type: 'collapse',
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id = '') {
                    if (id) {
                        (this.id == id) ?
                        this.state = true: '';
                    } else {
                        this.state = true;
                    }

                },
                close(id) {
                    if (id) {
                        (this.id == id) ? this.state = false: '';
                    } else {
                        this.state = false;
                    }

                },
                toggle(id) {
                    if (id) {
                        (this.id == id) ? this.state = !this.state: '';
                    } else {
                        this.state = !this.state;
                    }
                },
                getState() {
                    return this.state;
                },
                getId() {
                    return this.id;
                }
            }
        }
        function dropdownFn(id, config) {
            return {
                id: id,
                type: 'dropdown',
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id) {
                    if (id) {
                        this.state = (this.id == id);
                    } else {
                        this.state = true;
                    }

                },
                close(id) {
                    if (id) {
                        (this.id == id) ?
                        this.state = false: '';
                    } else {
                        this.state = false;
                    }

                },
                toggle(id) {
                    if (id) {
                        (this.id == id) ? this.state = !this.state: '';
                    } else {
                        this.state = !this.state;
                    }

                },
                getState() {
                    return this.state;
                },
                getId() {
                    return this.id;
                }
            }
        }
        function modalFn(id, config) {
            return {
                id: id,
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id = '') {
                    if (id) {
                        this.state = (this.id == id);
                    } else {
                        this.state = true;
                    }
                },
                close(id = '') {
                    if (id) {
                        this.id == id ? this.state = false : '';
                    } else {
                        this.state = false;
                    }
                },
                toggle(id = '') {
                    if (id) {
                        this.id == id ? this.state = !this.state : '';
                    } else {
                        this.state = !this.state;
                    }
                },
                getState() {
                    return this.state;
                },
                getId() {
                    return this.id;
                }
            }
        }
        function paginationFn(id, config)
        {
            return {
                id: id,
                currentPage: config.currentPage,
                totalPages: config.pages,
                pages: [],
                start: null,
                end: null,
                limit: config.limit,
                init(){
                    $stm.register(this);
                    this.visiblePages();
                },
                next(){
                    if(this.currentPage < this.totalPages){
                        this.currentPage++;
                        this.visiblePages();  
                    }
                },
                prev(){
                    if(this.currentPage > 1){
                        this.currentPage--;
                        this.visiblePages();
                    }
                },
                selectPage(page){
                    this.currentPage = page;
                    this.visiblePages();
                },
                visiblePages(){
                    this.pages = [];
                    this.start = Math.max(1, this.currentPage - Math.floor(this.limit / 2));
                    this.end = Math.min(this.totalPages, this.start + this.limit - 1);
                    this.start = Math.max(1, this.end - this.limit + 1);
                    for(let i = this.start; i <= this.end; i++){
                        this.pages.push(i);
                    }
                    this.sendEvent();
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
        function progressBarFn(id, config) {
            return {
                id: id,
                type: 'progressbar',
                lable:'',
                progress: 0,
                target: 0,
                duration: config.duration,
                interval: null,
                init(){
                    $stm.register(this);
                    this.setProgress(config.progress);
                },
                validateProgress(value){
                    if(isNaN(Number(value))) return 0;
                    value = Number(value);
                    value = value < 0 ? 0 : value;
                    value = value > 100 ? 100 : value;
                    return value;
                },
                setProgress(value) {
                    if (value == 'infinite') {
                        this.progress = -1;
                        return;
                    }
                    value = this.validateProgress(value);
                    if (this.progress > value) this.progress = 0;
                    this.target = value;
                    clearInterval(this.interval);
                    this.interval = setInterval(() => {
                        if(this.progress >= this.target) {
                            clearInterval(this.interval);
                            return;
                        }
                        this.progress += 1;
                    }, this.duration); // ~60fps
                },
                setLable(value) {
                    this.lable = value;
                },
                setDuration(value) {
                    this.duration = value;
                },
                getId() {
                    return this.id;
                },
                getType() {
                    return this.type;
                },
            };
        }
        function sideBarFn(id, config){
            return {
                id: id,
                type:'sidebar',
                state: config.state,
                breakpoint: config.breakpoint,
                init(){
                    $stm.register(this);
                    this.checkSize();
                },
                open(id='')
                {
                    if(id){
                        (this.id == id) ? this.state = true : '';
                    }else{
                        this.state = true;
                    }  
                },
                close(id='')
                {
                    if(id){
                        (this.id == id) ? this.state = false : '';
                    }else{
                        this.state = false;
                    }
                },
                toggle(id='')
                {
                    if(id){
                        (this.id == id) ? this.state = !this.state : '';
                    }else{
                        this.state = !this.state;
                    }
                },
                checkSize()
                {
                    if(window.innerWidth < this.breakpoint.width){
                        this.state = false;
                    }else{
                        this.state = true;
                    }
                },
                getState()
                {
                    return this.state;
                },
                getId()
                {
                    return this.id;
                },
            }
        }
        function tableFn(id, data, config){
            return {
                id: id,
                type: 'table',
                rows: [],
                selection: [],
                loading: false,
                selectable: false,
                selectAllBtn: null,
                sortable: true,
                sortProps: {},
                cardHeader: [],
                headers: {},
                allHeaders: {},
                init(){
                    $stm.register(this);
                    this.selectable = config.selectable;
                    this.selectAllBtn = config.selectAllBtn;
                    this.sortable = config.sortable;
                    this.setupData(data);
                },
                setupData(rows){
                    this.sortProps.unsortedRows = rows.slice();
                    this.rows = rows.slice();
                    this.setDefaultHeaders(rows);
                    this.setHeaders(config.table.headers);
                    this.setCardHeader(config.table.headers);
                },
                setDefaultHeaders(rows){
                    // set up all headers
                    if(rows.length > 0){
                        Object.keys(rows[0]).map(key => this.allHeaders[key] = key);
                        return;
                    }
                    this.allHeaders = {};                   
                },
                setHeaders(headers){
                    // set custom headers
                    if(Object.keys(headers).length > 0){
                        this.headers = this.headerValidation(headers) ? headers : this.allHeaders ;
                        return
                    }
                    // set default headers
                    this.headers = this.allHeaders;
                },
                setCardHeader(header){
                    if(Object.keys(header).length > 0){
                        let obj = this.headerValidation(header) ? header : this.headers;
                        this.cardHeader = [];
                        this.cardHeader.push(Object.keys(obj)[0], Object.values(obj)[0]);
                    }
                },
                headerValidation(headers){
                    let obj = Object.keys(headers)
                    let result = true;
                    if(obj.length > 0){
                        obj.forEach((key) => {
                            result &&= Object.keys(this.allHeaders).includes(key);    
                        })
                        return result;
                    }
                },
                removeSelect(){
                    this.selectable = false;
                    this.selection = [];
                },
                showSelect(){
                    this.selectable = true;
                    this.selection = [];
                },
                toggleSelect(){
                    this.selectable = !this.selectable;
                    this.selection = [];
                },
                select(row){
                    this.selection.includes(row) ? this.selection = this.selection.filter(r => r !== row) : this.selection.push(row);
                },
                selectAll(){
                    this.selection = this.selection.length === this.rows.length ? [] : this.rows;
                },
                getId(){
                    return this.id;
                },
                getSelection(){
                    return this.selection;
                },
                sortBy(key){
                    if(!this.sortable || !this.rows.length > 0) return;
                    if(this.sortProps.key == key){
                        this.sortProps.order = this.sortProps.order === 'asc' ? 'desc' : 'unsort';
                        this.sortProps.order === 'unsort' ? this.sortProps.key = '' : '';
                        this.sortRows(key, this.sortProps.order);
                        return;
                    } 
                    this.sortProps.order = 'asc',
                    this.sortProps.key = key;
                    this.sortRows(key, this.sortProps.order);
                },
                sortRows(key, order){
                    if(order == 'unsort'){
                        this.rows = this.sortProps.unsortedRows.slice();
                        return;
                    }
                    this.rows = this.rows.sort((a, b) => {
                            if(order === 'asc'){   
                                if(a[key] === b[key]) return 0;
                                return a[key] < b[key] ? -1 : 1;
                            }else if(order === 'desc'){
                                if(a[key] === b[key]) return 0;
                                return a[key] > b[key] ? -1 : 1;
                            }
                        }
                    );
                }
            }
        }
        function tabsFn(id, data, config = []) {
            return {
                id:id,
                tabs: data, // array of object lable, value, target, disabled
                activeTab: '',
                init(){
                    $stm.register(this);
                    this.$watch('activeTab', (value) => {
                        this.tabs.forEach((tab) => {
                            if (tab.value == this.activeTab) {
                                document.querySelector(tab.target).removeAttribute('style');
                            } else {
                                document.querySelector(tab.target).setAttribute('style', 'display:none;');
                            }
                        });
                    });
                    this.activateDefault();
                    
                },
                activate(value){
                    if(value == 'unknown'){
                        this.activeTab = value;
                        return;
                    }
                    if(this.checkIfDisabled(this.findTab(value))) return ;
                    this.activeTab = value;
                },
                findTab(value){
                    let [tab] = this.tabs.filter((tab) => {
                        return tab.value == value ;
                    });
                    return tab;
                },
                disable(value){
                    let tab = this.findTab(value)
                    tab.disabled = true;
                    if(this.activeTab == tab.value) {
                        this.activateDefault();
                    }
                    
                },
                enable(value){
                    let tab = this.findTab(value)
                    tab.disabled = false;
                    if(this.activeTab == 'unknown') this.activate(tab.value);
                },
                checkIfDisabled(tab){
                    if(tab.hasOwnProperty('disabled')) return tab.disabled == true;
                    return false;
                },
                getDefaultTab(){
                    let defaultTab = {value: 'unknown'};
                    for(let i=0; i < this.tabs.length; i++){
                    if(!this.checkIfDisabled(this.tabs[i])){
                        defaultTab = this.tabs[i];
                        break;
                    }
                    }
                    return defaultTab;
                },
                activateDefault(){
                    this.activate(this.getDefaultTab().value);
                },
            }            
        }

</script>

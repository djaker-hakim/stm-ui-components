// API 
//  available properties route, params
//  available methods href(), url(), getRoute(), getParams(),
//      href(url): accepts a url as argument just like the attribute href="#"
//      url(pathname, params) accepts a pathname '/users/...' and params object {id: 2, ...}
//      getRoute() getthe current route
//      getParames() get the current url parameters

window.$stm.router = (id) => {
    return {
        id: id,
        type: 'router',
        route: '',
        params: {},
        init(){
            $stm.register(this);
            this.load();
            window.addEventListener('popstate', (e) => {
                this.load();
            })
        },
        href(link){
            history.pushState({}, "",link);
            this.load();
        },
        url(pathname, params){
            url = new URL(location);
            url.pathname = pathname;
            url.search = this.setSearchParams(params);
            this.href(url);
        },
        setSearchParams(params){
            const searchParams = new URLSearchParams();
            for (const key in params) {
                searchParams.set(key, params[key]);
            }
            return searchParams.toString();
        },
        load(){
            this.route = location.pathname;
            const params = new URLSearchParams(location.search);
            this.params = Object.fromEntries(params.entries());
        },
        getCurrentRoute(){
            return this.route;
        },
        getParams(){
            return this.params
        }
    }
}
import { Controller } from '@hotwired/stimulus';
const prettify = require('html-prettify');

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['source', 'pretty']
    static values = {
        duration: {type: Number, default: 2000},
        title: {type: String, default: 'Hola' }
    }

    connect() {
        let msg = 'Hello from @tacman/html-prettify: ' + this.identifier;
        let html = this.hasSourceTarget ? this.sourceTarget.innerHTML : this.element.innerHTML;
        this.sourceTarget.innerHTML = "\n" + prettify(html) + "\n";

        // console.log(html);
        // let pretty = prettify(html);
        // console.log(pretty);
        // this.prettyTarget.innerHTML = pretty;
    }


    // ...
}

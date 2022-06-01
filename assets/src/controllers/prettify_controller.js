import { Controller } from '@hotwired/stimulus';
const prettify = require('html-prettify');

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['source']
    static values = {
        duration: {type: Number, default: 2000},
        title: {type: String, default: 'Hola' }
    }

    connect() {
        let msg = 'Hello from @tacman/html-prettify: ' + this.identifier;
        composer.log(msg);
        this.prettify(this.sourceTarget.innerHTML);
    }

    prettify(source) {
        console.log(source);

    }

    // ...
}

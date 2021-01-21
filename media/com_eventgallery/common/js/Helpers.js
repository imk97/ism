function removeElement(array, elm) {
    const index = array.indexOf(elm);
    if (index > -1) {
        array.splice(index, 1);
    }
}

function mergeObjects(defaults, options) {
    if (options === null || defaults === null) {
        return defaults;
    }

    for (let key in options) {
        defaults[key] = options[key];
    }

    return defaults;
}

/**
 * calculates the border of the given elements with the given properties
 */
function calcBorderWidth(elements, properties) {
    let sum = 0;

    for (let i=0; i<elements.length; i++) {
        for (let j=0; j<properties.length; j++) {
            let value = parseFloat( elements[i].css(properties[j]) );
            if (!isNaN(value)) {
                sum += value;
            }
        }
    }

    return sum;
}

function addUrlHashParameter(initialUrl, key, value) {
    let url = removeUrlHashParameter(initialUrl, key),
        fragments = url.split('#'),
        urlpart = fragments[0],
        hashparts = fragments.length>1? fragments[1].split("&") : [],
        result;

    hashparts.push(encodeURIComponent(key) + "=" + encodeURIComponent(value));

    if (hashparts.length>0) {
        result = urlpart + '#' + hashparts.join('&');
    } else {
        result = urlpart;
    }

    return result;
}

function getUrlHashParameterValue(url, key) {
    let fragments=url.split('#'),
        hashparts = fragments.length>1? fragments[1].split("&") : [],
        result;

    if (hashparts.length>0)
    {
        let prefix= encodeURIComponent(key)+'=';

        for (let i=0; i<hashparts.length; i++) {
            if (hashparts[i].indexOf(prefix, 0) === 0) {
                result = hashparts[i].replace(prefix, '');
            }
        }
    }

    return result;
}

function removeUrlHashParameter(url, key) {
    let fragments=url.split('#'),
        urlpart= fragments[0],
        hashparts = fragments.length>1? fragments[1].split("&") : [],
        result;

    if (hashparts.length>0)
    {
        let prefix= encodeURIComponent(key)+'=',
            newHashParts = [];

        for (let i=0; i<hashparts.length; i++) {
            if (hashparts[i].indexOf(prefix, 0) === 0) {

            } else {
                newHashParts.push(hashparts[i]);
            }
        }
        hashparts = newHashParts;
    }

    if (hashparts.length>0) {
        result = urlpart + '#' + hashparts.join('&');
    } else {
        result = urlpart;
    }

    return result;
}

function addUrlParameter(initialUrl, key, value) {
    let url = removeUrlParameter(initialUrl, key),
        fragments = url.split('#'),
        urlparts= fragments[0].split('?'),
        result;

    if (urlparts.length === 1) {
        result = urlparts[0] + '?' + encodeURIComponent(key) + "=" + encodeURIComponent(value);
    } else {
        result = urlparts.join('?') + '&' + encodeURIComponent(key) + "=" + encodeURIComponent(value);
    }

    if (fragments.length>1) {
        return result + '#' + fragments[1];
    }

    return result;
}

function removeUrlParameter(url, key) {
    let fragments=url.split('#'),
        urlparts= fragments[0].split('?'),
        result;

    if (urlparts.length>1)
    {
        let prefix= encodeURIComponent(key)+'=';
        let pars= urlparts[1].split('&');

        for (let i=0; i<pars.length; i++) {
            if (pars[i].indexOf(prefix, 0) === 0) {
                pars.splice(i, 1);
            }
        }
        if (pars.length > 0) {
            result = urlparts[0] + '?' + pars.join('&');
        }
        else {
            result = urlparts[0];
        }
    }
    else {
        result =  urlparts[0];
    }

    if (fragments.length>1) {
        return result + '#' + fragments[1];
    }

    return result;
}

function setCSSStyle (nodes, style, value) {
    for (let i=0; i<nodes.length; i++) {
        nodes[i].style[style] = value;
    }
}

/**
 *
 * @param node HTMLElement
 */
function getParents(node) {
    let parents = [];

    if (node === null) {
        return parents;
    }

    while(node.parentElement != null) {
        let parent = node.parentElement;
        parents.push(parent);
        node = parent;
    }
    return parents;
}

/*!
 * Serialize all form data into a query string
 * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
 * Modified to use any HTML element instead of a form element.
 * @param  {Node}   form The form container to serialize
 * @return {String}      The serialized form data
 */
var serializeForm = function (form) {

    // Setup our serialized data
    var serialized = [];

    let inputElements = form.querySelectorAll('input,select,textarea');
    // Loop through each field in the form
    for (var i = 0; i < inputElements.length; i++) {

        var field = inputElements[i];

        // Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields
        if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;

        // If a multi-select, get all selections
        if (field.type === 'select-multiple') {
            for (var n = 0; n < field.options.length; n++) {
                if (!field.options[n].selected) continue;
                serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[n].value));
            }
        }

        // Convert field data to a query string
        else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
            serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value));
        }
    }

    return serialized.join('&');

};

export { removeElement, addUrlHashParameter, calcBorderWidth, mergeObjects, addUrlParameter, getUrlHashParameterValue, removeUrlHashParameter, removeUrlParameter, setCSSStyle, getParents, serializeForm };
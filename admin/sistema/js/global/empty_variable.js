emptyVariable = (obj) => {

    let isEmpty = false;

    if (typeof obj == 'undefined' || obj === null || obj === '') {
        isEmpty = true;
    }

    if (typeof obj == 'number' && isNaN(obj)) {
        isEmpty = true;
    }

    if (obj instanceof Date && isNaN(Number(obj))) {
        isEmpty = true;
    }

    return isEmpty;
}
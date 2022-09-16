import {demoState} from "./data";

export const reducerFilters = (state = demoState.filters, action) => {
    switch (action.type) {
        case 'filter/set_text':
            //return {...state, ...action}// or
            return {...state, text: action.text}
        case 'filter/date_sort':
            //return {...state, ...action}// or
            return {...state, sortBy: 'date'}
        case 'filter/amount_sort':
            //return {...state, ...action}// or
            return {...state, sortBy: 'amount'}
        case 'filter/startDate':
            //return {...state, ...action}// or
            return {...state, startDate: action.startDate}
        case 'filter/endDate':
            //return {...state, ...action}// or
            return {...state, endDate: action.endDate}
        default:
            return state;
    }

};


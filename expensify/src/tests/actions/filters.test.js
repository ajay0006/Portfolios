import {setEndDate, setStartDate, setTextFilter, sortDateFilter, sortAmountFilter} from "../../actions/filtersActions";
import {DateTime} from 'luxon';


test('generates a start date action object',() =>{
    const filter = setStartDate(DateTime.fromMillis(0))
    expect(filter).toEqual({
        type: 'filter/startDate',
        startDate: DateTime.fromMillis(0)
    })

});

test('generates a end date action object',() =>{
    const filter = setEndDate(DateTime.fromMillis(0))
    expect(filter).toEqual({
        type: 'filter/endDate',
        endDate: DateTime.fromMillis(0)
    })

});

test('generates a text filter action object',() =>{
    const text = "lorem"
    const filter = setTextFilter(text)
    expect(filter).toEqual({
        type: 'filter/set_text',
        text
    })

});

test('generates a text filter default action object',() =>{
    const text = '';
    const filter = setTextFilter()
    expect(filter).toEqual({
        type: 'filter/set_text',
        text
    })

});

test('generates a date filter action object',() =>{
    const filter = sortDateFilter();
    expect(filter).toEqual({
        type: "filter/date_sort"
    })

})

test('generates an amount filter action object',() =>{
    const filter = sortAmountFilter();
    expect(filter).toEqual({
        type: "filter/amount_sort"
    })

})
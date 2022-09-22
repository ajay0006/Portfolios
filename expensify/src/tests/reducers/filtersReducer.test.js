import {reducerFilters} from "../../reducers/filtersReducer";
import {DateTime} from "luxon";


const filters = {
    text: "",
    sortBy: "",
    startDate: undefined,
    endDate: undefined
}

test('should setup default filter values', () => {
    const state = reducerFilters(undefined, {type: "@@INIT"})
    expect(state).toEqual({
        ...filters
    })
})

test("should set filter value to text", () => {
    const text = 'lorem ipsum'
    const state = reducerFilters(undefined, {type: 'filter/set_text', text});
    expect(state).toEqual({
        ...filters, text
    })
})

test("should set filter value to start Date", () => {
    const startDate = DateTime.fromMillis(0).ts
    const state = reducerFilters(filters, {type: 'filter/startDate', startDate});
    expect(state).toEqual({
        ...filters, startDate
    })
})
test("should set filter value to end Date", () => {
    const endDate = DateTime.fromMillis(0).ts
    const state = reducerFilters(filters, {type: 'filter/endDate', endDate});
    expect(state).toEqual({
        ...filters, endDate
    })
})
test("should set filter value to amount", () => {
    const state = reducerFilters(filters, {type: 'filter/amount_sort'});
    expect(state).toEqual({
        ...filters, sortBy: 'amount'
    })
})

test("should set filter value to date", () => {
    const state = reducerFilters(filters, {type: 'filter/date_sort'});
    expect(state).toEqual({
        ...filters, sortBy: 'date'
    })
})


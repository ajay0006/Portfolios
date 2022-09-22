import {getVisibleExpenses} from "../../selectors/expensesSelector";
import {DateTime} from "luxon";

const expenses = [
    {
        id: '1',
        description: 'dog',
        note: '',
        amount: 100,
        dateCreated: 0
    },
    {
        id: '2',
        description: 'cat',
        note: '',
        amount: 1000,
        dateCreated: DateTime.fromMillis(0).plus({days: 2}).ts
    },
    {
        id: '3',
        description: 'rabbit',
        note: '',
        amount: 10000,
        dateCreated: DateTime.fromMillis(0).minus({months: 2}).ts
    },
    {
        id: '4',
        description: 'goat',
        note: '',
        amount: 100000,
        dateCreated: DateTime.fromMillis(0).plus({years: 2}).ts
    }
]

test("should filter by text value", () =>
{
    const filters = {text: 'a', sortBy: 'date', startDate: undefined, endDate: undefined}
    const result = getVisibleExpenses(expenses, filters);
    expect(result).toEqual([expenses[3], expenses[1], expenses[2]])
})

test("should filter by start date", () =>
{
    const filters = {text: '', sortBy: 'date', startDate: DateTime.fromMillis(0).ts, endDate: undefined}
    const result = getVisibleExpenses(expenses, filters);
    expect(result).toEqual([expenses[3], expenses[1], expenses[0]])
})

test("should sort by date", () =>
{
    const filters = {text: '', sortBy: 'date', startDate: undefined, endDate: undefined}
    const result = getVisibleExpenses(expenses, filters);
    expect(result).toEqual([expenses[3], expenses[1], expenses[0], expenses[2]])
})

test("should sort by amount", () =>
{
    const filters = {text: '', sortBy: 'amount', startDate: undefined, endDate: undefined}
    const result = getVisibleExpenses(expenses, filters);
    expect(result).toEqual([expenses[3], expenses[2], expenses[1], expenses[0]])
})
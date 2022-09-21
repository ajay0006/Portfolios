import {addExpense, editExpense, removeExpense} from "../../actions/expensesAction";
import {v4 as uuidV4} from "uuid";


test('should return an actions object for remove expense', () => {
    const id = uuidV4();
    const actionResult = removeExpense({id: id});
    expect(actionResult).toEqual({
        type: 'expense/remove',
        id: id
    })
})

test('should return an actions object that matches an id for edit expense', () => {
    const id = uuidV4();
    const actionResult = editExpense(id, {});
    expect(actionResult).toEqual({
        type: 'expense/edit',
        expense: {
            id
        }
    })
})

test('should return an actions object that matches itself for default values add expense', () => {
    const actionResult = addExpense();
    expect(actionResult).toEqual({
        type: 'expense/add',
        expense: {
            id: expect.any(String),
            description: '',
            note: '',
            amount: 0,
            dateCreated : 0
        }
    })
})

test('should return an actions object for added values for add expense', () => {
    const expenseObject =   {
        description: '',
        note: '',
        amount: 0,
        dateCreated : 0
    }
    const actionResult = addExpense( expenseObject);
    expect(actionResult).toEqual({
        type: 'expense/add',
        expense: {
            id: expect.any(String),
            ...expenseObject
        }
    })
})
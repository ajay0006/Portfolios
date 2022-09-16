import {demoState} from "./data";

export const reducerExpenses = (state = demoState.expenses, action) => {
    switch (action.type) {
        case 'expense/add':
            // return {expenses: state.expenses.concat(action.expense)} // I used concat instead of push, because concat creates a new array and satisfies the immutable rule of redux, while push changes the original array
            //return state.concat(action.expense)
            return [...state, action.expense]; // create a new array, grab items from an existing array, in this case is the state, and add the expense object at the end
        case 'expense/edit':
            // I always forget, but MAP goes through every item in the array
            return state.map((expense) => {
                if (expense.id === action.expense.id) {
                    //spread the expense object and replace it with the spread action.expense object
                    return {...expense, ...action.expense}
                } else {
                    return expense
                }
            });
        case 'expense/remove':
            // return state.filter(item => !(item.id === action.id))
            return state.filter(({id}) => id !== action.id) // can either use this method or use the one above
        default:
            return state;
    }
};
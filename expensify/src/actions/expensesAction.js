import {v4 as uuidV4} from "uuid";

// these are the actions used

export const addExpense = (
    {
        description = '',
        note = '',
        amount = 0,
        dateCreated = 0
    } = {}  // destructure the argument, if no argument is passed then assign it to an empty object {}
) => ({
    type: 'expense/add',
    expense: {
        id: uuidV4(),
        description: description,
        note: note,
        amount,
        dateCreated
        // above I used the two styles, assigning both desc and notes to their respective equivalently named variables or just using the variables directly
        // since the variable name and the field are identical in name
    }
})

export const editExpense = (id, {description, note, amount, dateCreated}) => {
    //console.log(description, note, amount, dateCreated);
    return (
        {

//export const editExpense = (id, updates) => ({
            type: 'expense/edit',
            expense: {
                id,
                // description: updates.description,
                // note: updates.note,
                // amount: updates.amount,
                // dateCreated: updates.dateCreated
                description,
                note,
                amount,
                dateCreated
            },
        }
    )}

    export const removeExpense = ({id} = {}) => ({ // this does the same as above, it just uses object destructuring
        type: "expense/remove",
        id
    });


// export const editExpense = (id, {description, amount, note, dateCreated}) => ({
// //export const editExpense = (id, updates) => ({
//     type: 'expense/edit',
//     expense: {
//         id,
//         // description: updates.description,
//         // note: updates.note,
//         // amount: updates.amount,
//         // dateCreated: updates.dateCreated
//         description,
//         amount,
//         note,
//         dateCreated
//     }
// })
import {v4 as uuidV4} from "uuid";

export const demoState = {
    expenses: [
        {
            id: uuidV4(),
            description: "December's Rent",
            note: 'This was the final payment for that address',
            amount: 54500,
            dateCreated: 98787778998
        },
        {
            id: uuidV4(),
            description: "Gas Bill",
            note: 'Monthly Gas bill for my car',
            amount: 245,
            dateCreated: -68787778998
        },
        {
            id: uuidV4(),
            description: "Hydro Bill",
            note: 'Monthly bill for the month',
            amount: 398,
            dateCreated: 2768787778998
        },
        {
            id: uuidV4(),
            description: "Insurance",
            note: 'Insurance bill for the car',
            amount: 700,
            dateCreated: 68787778998
        },
        {
            id: uuidV4(),
            description: "Groceries",
            note: 'food bill for the month',
            amount: 2000,
            dateCreated: 1657687877
        }
    ],
    filters: {
        text: "",
        sortBy: "",
        startDate: undefined,
        endDate: undefined
    }
};
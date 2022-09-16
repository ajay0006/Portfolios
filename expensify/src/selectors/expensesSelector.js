export const getVisibleExpenses = (expenses, {text, sortBy, startDate, endDate}) => {
    return expenses.filter((expense) =>{
        const startDateMatch = typeof startDate !== "number" || expense.dateCreated >= startDate;
        const endDateMatch = typeof endDate !== "number" || expense.dateCreated <= endDate;
        const textMatch = typeof text !== 'string' || expense.description.toLowerCase().includes(text.toLowerCase());
        return startDateMatch && endDateMatch && textMatch
    }).sort((a, b) =>{
        if (sortBy === 'amount')
        {
            return a.amount < b.amount ? 1 : -1;

        }

        else
        {
            return a.dateCreated < b.dateCreated ? 1 : -1
        }
    })
}

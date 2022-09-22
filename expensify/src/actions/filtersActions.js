// these are the filter actions used

const setTextFilter = (text = '') => ({
    type: 'filter/set_text',
    text
})

const sortDateFilter = () => ({
    type: 'filter/date_sort',
})

const sortAmountFilter = () => ({
    type: 'filter/amount_sort',
})

const setStartDate = (startDate = undefined) => ({
    type: 'filter/startDate',
    startDate
})

const setEndDate = (endDate=undefined) => ({
    type: 'filter/endDate',
    endDate
})

export {setTextFilter, sortDateFilter, sortAmountFilter, setStartDate, setEndDate}
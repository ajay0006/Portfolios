import React from "react";
import ReactDOM from 'react-dom/client';
import {Provider} from "react-redux";
import ReduxExpensifyStore from "./store/store";
//import {getVisibleExpenses} from "./selectors/expensesSelector";
import Expensify from "./components/Expensify";

const store = ReduxExpensifyStore;
// store.dispatch(addExpense({description: "Water Bill"}))
// store.dispatch(addExpense({description: "Gas Bill"}))
// store.dispatch(setTextFilter(''))

// setTimeout(() => {
//     store.dispatch(setTextFilter('bill'));
// }, 3000)


//const state = store.getState();
//const visibleExpense = getVisibleExpenses(state.reducerExpenses, state.reducerFilters)


ReactDOM.createRoot(document.getElementById('exp')).render(<Provider store={store}> <Expensify/></Provider>);
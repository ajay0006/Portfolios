import {combineReducers} from "redux";
import {reducerExpenses} from "../reducers/expensesReducer";
import {reducerFilters} from "../reducers/filtersReducer";
import {configureStore} from "@reduxjs/toolkit";

const CombinedReducers = combineReducers({reducerExpenses, reducerFilters});
const ReduxExpensifyStore = configureStore({reducer: CombinedReducers});


export default ReduxExpensifyStore;
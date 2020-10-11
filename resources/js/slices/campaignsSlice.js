import {
    createSlice,
    createAsyncThunk,
    createEntityAdapter,
    createSelector
} from '@reduxjs/toolkit';
import api from '../app/api';

export const fetchCampaignById = createAsyncThunk(
    'campaigns/fetchByIdStatus',
    async (id, thunkAPI) => {
        const response = await api.get(`/campaign/${id}`);

        return response.data;
    }
);

export const fetchCampaignBySlug = createAsyncThunk(
    'campaigns/fetchBySlugStatus',
    async (slug, thunkAPI) => {
        const response = await api.get(`/campaign/slug/${slug}`);

        return response.data;
    }
);

export const campaignsAdapter = createEntityAdapter();

const initialState = campaignsAdapter.getInitialState();

export const campaignsSlice = createSlice({
    name: 'campaigns',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(
            fetchCampaignById.fulfilled,
            campaignsAdapter.upsertOne
        );
        builder.addCase(
            fetchCampaignBySlug.fulfilled,
            campaignsAdapter.upsertOne
        );
    }
});

export default campaignsSlice.reducer;

export const {
    selectById: selectCampaignById,
    selectAll: selectAllCampaigns
} = campaignsAdapter.getSelectors(state => state.campaign);

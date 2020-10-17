import React, { Component } from 'react';
import { connect } from 'react-redux';
import {
    fetchCampaignBySlug,
    saveCampaignAnswers
} from '../slices/campaignsSlice';
import { fetchInviteByToken } from '../slices/inviteSlice';
import queryString from 'query-string';
import CircularProgress from '@material-ui/core/CircularProgress';
import CampaignForm from '../components/CampaignForm';

class Campaign extends Component {
    componentDidMount() {
        const qs = queryString.parse(this.props.location.search);

        if (qs.token) {
            //this.props.fetchCampaignByToken(qs.token);
            this.props.fetchInviteByToken(qs.token);
        } else {
            this.props.fetchCampaignBySlug(this.props.match.params.slug);
        }
    }

    render() {
        const { campaign } = this.props;

        if (this.props.loading === 'pending') {
            return <CircularProgress />;
        } else if (this.props.error) {
            return <h1>Došlo je do greške</h1>;
        }

        return (
            <CampaignForm
                campaign={campaign}
                saveFn={this.props.saveCampaignAnswers}
            />
        );
    }
}

const mapStateToProps = state => {
    return {
        loading: state.invite.loading,
        error: state.invite.error,
        campaign: state.invite.data.campaign
    };
};

export default connect(mapStateToProps, {
    fetchCampaignBySlug,
    //fetchCampaignByToken,
    fetchInviteByToken,
    saveCampaignAnswers
})(Campaign);

import React, { Component } from 'react';
import { withStyles } from '@material-ui/core';
import { connect } from 'react-redux';
import { compose } from 'redux';
import {
    fetchCampaignBySlug,
    saveCampaignAnswers
} from '../slices/campaignsSlice';
import { fetchInviteByToken } from '../slices/inviteSlice';
import queryString from 'query-string';
import CircularProgress from '@material-ui/core/CircularProgress';
import CampaignForm from '../components/CampaignForm';
import CampaignHeader from '../components/CampaignHeader';

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
        const { campaign, responses, page, classes } = this.props;

        if (this.props.loading === 'pending') {
            return <CircularProgress />;
        } else if (this.props.error) {
            return <h1>Došlo je do greške</h1>;
        }

        return (
            <div className={classes.root}>
                <CampaignHeader title={campaign.title} />
                <CampaignForm
                    campaign={campaign}
                    saveFn={this.props.saveCampaignAnswers}
                    initialValues={responses.reduce((obj, item) => {
                        return Object.assign(obj, {
                            [item.question.code]: item.answer
                        });
                    }, {})}
                    page={page}
                />
            </div>
        );
    }
}

const mapStateToProps = state => {
    return {
        loading: state.invite.loading,
        error: state.invite.error,
        campaign: state.invite.data.campaign,
        responses: state.invite.data.responses,
        page: state.invite.data.page
    };
};

const styles = theme => ({
    root: {
        margin: theme.spacing(3)
    }
});

export default compose(
    withStyles(styles, { withTheme: true }),
    connect(mapStateToProps, {
        fetchCampaignBySlug,
        fetchInviteByToken,
        saveCampaignAnswers
    })
)(Campaign);

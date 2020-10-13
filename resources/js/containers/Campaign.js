import React, { Component } from 'react';
import { withStyles } from '@material-ui/core';
import { connect } from 'react-redux';
import { reduxForm, Field } from 'redux-form';
import { compose } from 'redux';
import {
    fetchCampaignBySlug,
    fetchCampaignByToken,
    saveCampaignAnswers,
} from '../slices/campaignsSlice';
import queryString from 'query-string';
import CircularProgress from '@material-ui/core/CircularProgress';
import Question from '../components/Question';
import Button from '@material-ui/core/Button';

class Campaign extends Component {
    componentDidMount() {
        const qs = queryString.parse(this.props.location.search);

        if (qs.token) {
            this.props.fetchCampaignByToken(qs.token);
        } else {
            this.props.fetchCampaignBySlug(this.props.match.params.slug);
        }
    }

    onSubmit(formValues) {
        console.log(formValues);
        this.props.saveCampaignAnswers({
            campaign_id: this.props.campaign.id,
            data: formValues,
        });
    }

    render() {
        const { campaign, handleSubmit, classes } = this.props;

        if (this.props.loading === 'pending') {
            return <CircularProgress />;
        } else if (this.props.error) {
            return <h1>Došlo je do greške</h1>;
        }

        return (
            <form onSubmit={handleSubmit(this.onSubmit.bind(this))}>
                {campaign.questions.map((q) => (
                    <Question key={q.id} question={q} />
                ))}
                <Button
                    variant="contained"
                    color="primary"
                    type="submit"
                    className={classes.button}
                >
                    Save & continue later
                </Button>
                <Button
                    variant="contained"
                    color="primary"
                    type="submit"
                    className={classes.button}
                >
                    Save & finish
                </Button>
            </form>
        );
    }
}

const styles = (theme) => ({
    button: {
        marginLeft: theme.spacing(3),
    },
});

const mapStateToProps = (state) => {
    return {
        loading: state.campaign.loading,
        error: state.campaign.error,
        campaign: state.campaign.data,
    };
};

export default compose(
    withStyles(styles, { withTheme: true }),
    reduxForm({ form: 'campaignForm' }),
    connect(mapStateToProps, {
        fetchCampaignBySlug,
        fetchCampaignByToken,
        saveCampaignAnswers,
    })
)(Campaign);

import React from 'react';
import PropTypes from 'prop-types';
import { reduxForm } from 'redux-form';
import { withStyles } from '@material-ui/core';
import { compose } from 'redux';
import { isEmpty } from 'lodash';
import StepWizard from 'react-step-wizard';
import Question from '../containers/Question';
import CampaignMessage from './CampaignMessage';

const CampaignForm = ({
    handleSubmit,
    saveFn,
    campaign: { questions, messages },
    classes,
    page
}) => {
    const onSubmit = formValues => {
        saveFn({
            campaign_id: campaign.id,
            data: formValues
        });
    };

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <StepWizard initialStep={page}>
                <CampaignMessage message={messages.intro} type="intro" />
                {questions.map((q, idx) => (
                    <Question
                        key={q.id}
                        question={{ ...q, step: idx + 1 }}
                        conditionalJump={
                            !isEmpty(q.conditions) &&
                            questions.indexOf(
                                questions.find(item => {
                                    return (
                                        item.id ===
                                        parseInt(q.conditions[0].question_id)
                                    );
                                })
                            ) + 1
                        }
                    />
                ))}
                <CampaignMessage message={messages.final} type="final" />
            </StepWizard>
        </form>
    );
};

CampaignForm.propTypes = {
    saveFn: PropTypes.func.isRequired,
    campaign: PropTypes.object.isRequired
};

const styles = theme => ({
    button: {
        marginLeft: theme.spacing(3)
    }
});

export default compose(
    reduxForm({ form: 'campaignForm' }),
    withStyles(styles, { withTheme: true })
)(CampaignForm);

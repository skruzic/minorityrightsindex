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
    page
}) => {
    const onSubmit = formValues => {
        !!saveFn &&
            saveFn({
                campaign_id: campaign.id,
                data: formValues
            });
    };

    const handleConditionals = () => {
        return q.conditions.map(c =>
            questions.indexOf(
                questions.find(item => {
                    return item.id === parseInt(c.question_id);
                })
            )
        );
    };

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <StepWizard
                initialStep={page}
                isHashEnabled={true}
                isLazyMount={true}
            >
                <CampaignMessage message={messages.intro} type="intro" />
                {questions.map((q, idx) => (
                    <Question
                        key={q.id}
                        question={{ ...q, step: idx + 1 }}
                        conditionalJumps={
                            !isEmpty(q.conditions) &&
                            q.conditions.map(c => {
                                return questions.findIndex(
                                    item => item.id === parseInt(c.question_id)
                                );
                            })
                        }
                        hashKey={q.code}
                        saveFn={saveFn}
                    />
                ))}
                <CampaignMessage
                    message={messages.final}
                    type="final"
                    saveFn={saveFn}
                />
            </StepWizard>
        </form>
    );
};

CampaignForm.propTypes = {
    saveFn: PropTypes.func,
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

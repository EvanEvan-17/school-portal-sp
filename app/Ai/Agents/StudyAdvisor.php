<?php

namespace App\Ai\Agents;

use App\Models\User;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class StudyAdvisor implements Agent, Conversational, HasStructuredOutput, HasTools
{
    use Promptable;
    public function __construct(
        public User $student
    ) {}
    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are a school study-planning assistant.

            Help the student prioritize assignments and make a realistic plan according to the level of the tasks and the due dates.
            Do not diagnose mental health conditions.
            If the student sounds unsafe or in crisis, tell them to contact a trusted adult, counselor, teacher, or parent.';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'summary' => $schema->string()->required(),
            'first_task' => $schema->string()->required(),
            'today_plan' => $schema->array()
                ->items($schema->string())
                ->required(),
            // 'message_to_teacher' => $schema->string()->required(),
            'risk_level' => $schema->string()
                ->enum(['normal', 'overwhelmed', 'urgent'])
                ->required(),
        ];
    }
}

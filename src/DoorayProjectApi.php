<?php

namespace NhnEdu\PhpDooray;

class DoorayProjectApi extends DoorayServiceApiBase {
	public function getProject($projectId) {
		return $this->_project->getJSON('/projects/'.$projectId);
	}

	public function getOrganizationMemberIdByProjectMember($projectId, $memberId) {
		$result = $this->_project->getJSON('/projects/'.$projectId.'/members/'.$memberId);
		return isset($result->organizationMemberId) ? $result->organizationMemberId : null;
	}

	public function getProjectWorkflows($projectId) {
		return $this->_project->getJSON('/projects/'.$projectId.'/workflows');
	}

	public function getTask($projectId, $postId) {
		return $this->_project->getJSON('/projects/'.$projectId.'/posts/'.$postId);
	}

	public function getTasks($projectId, $page = 0, $size = 100, $filters = []) {
		return $this->getProjectList('/projects/'.$projectId.'/posts', $page, $size, $filters);
	}

	public function getAllTasks($projectId, $filters = []) {

		$page = 0;
		$results = [];

		do {
			$taskList = $this->getProjectList('/projects/'.$projectId.'/posts', $page, 100, $filters);

			if (sizeof($taskList) < 1) {
				break;
			}

			$results = array_merge($results, $taskList);
			$page++;
		}
		while (true);

		return $results;
	}

	public function postTask(	$projectId,
								$subject, 
								$bodyMimeType = 'text/x-markdown',
								$bodyContent = '',
								$to = null,
								$cc = null,
								$milestoneId = null,
								$tagIds = [],
								$priority = 'none') {

		$requestBody = [];

		$requestBody['parentPostId'] = null;
		$requestBody['users'] = ['to' => $to, 'cc' => $cc];
		$requestBody['subject'] = $subject;
		$requestBody['body'] = [
				'mimeType'	=> $bodyMimeType,
				'content'	=> $bodyContent
			];

		$requestBody['dueDate'] = null;
		$requestBody['milestoneId'] = $milestoneId;
		$requestBody['tagIds'] = $tagIds;
		$requestBody['priority'] = $priority;

		return $this->_project->postJSON('/projects/'.$projectId.'/posts', $requestBody);
	}

	public function setPostDone($projectId, $postId ) {
		return $this->_project->postJSON('/projects/'.$projectId.'/posts/'.$postId.'/set-done');
	}

	public function postLog($projectId, $postId, $content, $mimeType = 'text/x-markdown') {
		$requestBody = [
				"body" => [
					"content" => $content,
					"mimeType" => $mimeType
				]
			];

		return $this->_project->postJSON('/projects/'.$projectId.'/posts/'.$postId.'/logs', $requestBody);
	}
}


import { Component, OnInit } from '@angular/core';
import { Version } from './version';

@Component({
	selector: 'app-root',
	templateUrl: './app.component.html',
	styleUrls: ['./app.component.scss'],
})
export class AppComponent implements OnInit {
	title = 'shereef';

	ngOnInit() {
		this.appendVersionInfo();
	}

	/**
	 * Appends the deploy time and short commit hash in the html as a comment after the <app-root> element.
	 */
	appendVersionInfo() {
		const commentsToInsert: string[] = [];
		const versionDeployTimeISO = Version.deployTimeString;
		const env = Version.buildEnvironment;
		const versionCommitDateTime = Version.commitTimeString;
		const versionCommitId = Version.commitId;
		const versionBranchName = Version.branchName;
		const buildNumberDateTimeString = versionCommitDateTime;
		const buildNumberHash = versionCommitId;
		const buildBranchName = versionBranchName;
		const buildNumberDateTime = new Date(buildNumberDateTimeString);
		const buildNumberDateString =
			buildNumberDateTime.getFullYear() +
			'.' +
			(buildNumberDateTime.getMonth() + 1).toString().padStart(2, '0') +
			'.' +
			buildNumberDateTime.getDate().toString().padStart(2, '0');
		const versionHtmlComment =
			buildNumberDateString || buildNumberHash
				? `${buildNumberDateString}-${buildNumberHash}`
				: '';
		if (versionHtmlComment) {
			commentsToInsert.push(
				`<!-- BUILD NUMBER: ${versionHtmlComment} -->`
			);
		}
		if (versionDeployTimeISO) {
			commentsToInsert.push(
				`<!-- DEPLOY TIME: ${versionDeployTimeISO} -->`
			);
		}
		if (env) {
			commentsToInsert.push(`<!-- Environment: ${env} -->`);
		}

		if (versionCommitDateTime) {
			commentsToInsert.push(`<!-- COMMIT ID: ${versionCommitId} -->`);
		}
		if (buildBranchName) {
			commentsToInsert.push(`<!-- Branch name: ${buildBranchName} -->`);
		}
		if (commentsToInsert && commentsToInsert.length) {
			const html: string = commentsToInsert.join('\r\n');
			const rootElement = document.querySelector('app-root');
			if (rootElement) {
				rootElement.insertAdjacentHTML('afterend', html);
			}
		}
	}
}

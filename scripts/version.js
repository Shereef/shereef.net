const fs = require('fs-extra');
const chalk = require('chalk');
const argv = require('yargs').argv;
const { execSync } = require('child_process');

const buildEnvironment = argv.buildEnv || 'prod';

// Print node js version
const nodeVersion = execSync('node -v');
console.log(chalk.green(`Node version: ${nodeVersion}`));
console.log(chalk.green(`Build Env: ${buildEnvironment}`));
const commitIdLong = execSync('git rev-parse HEAD').toString().trim();
const commitId = execSync('git rev-parse --short HEAD').toString().trim();
const commitTime = execSync('git log -1 --format=%cd').toString().trim();
const commitTimeString = new Date(commitTime).toISOString();
const deployTime = new Date().toISOString();
const branchName = execSync('git rev-parse --abbrev-ref HEAD')
	.toString()
	.trim();

console.log(chalk.yellow(`Branch name: '${branchName}'`));
console.log(chalk.yellow(`Deploy Date & Time: '${deployTime}'`));
console.log(chalk.yellow(`Commit Hash: '${commitIdLong}'`));
console.log(chalk.yellow(`Commit Hash Short: '${commitId}'`));
console.log(chalk.yellow(`Commit Date & Time: '${commitTimeString}'`));

const versionTypeScriptPath = './src/app/version.ts';
console.log(chalk.green(`versionTypeScriptPath: ${versionTypeScriptPath}`));
const tsFileContent =
	`export class Version{public static commitId='${commitId}';` +
	`public static commitTimeString='${commitTimeString}';` +
	`public static deployTimeString='${deployTime}';` +
	`public static buildEnvironment='${buildEnvironment}';` +
	`public static branchName='${branchName}';}`;

try {
	if (fs.existsSync(versionTypeScriptPath)) {
		// Clean out destination config folder
		fs.removeSync(versionTypeScriptPath);
		console.log(chalk.green(`Version file exists and deleted`));
	}
} catch (err) {
	console.log(chalk.red('Version File Delete Failed!'));
	console.error(chalk.red(err));
}
try {
	fs.writeFile(versionTypeScriptPath, tsFileContent);
	console.log(chalk.green(`Version file Written`));
} catch (err) {
	console.log(chalk.red('Version file Write Failed!'));
	console.error(chalk.red(err));
}

console.log(
	chalk.yellow(
		`Added commit hash to version file ${versionTypeScriptPath}, result:`
	)
);
console.log(chalk.yellow(tsFileContent));
